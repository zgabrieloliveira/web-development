<?php

class Paciente
{
    // cliente é uma tabela com chave estrangeira da tabela pessoa
    static function Create(
        $pdo,
        $nome,
        $sexo,
        $email,
        $peso,
        $altura,
        $tipoSanguineo
    ) {
        try {
            // para realizar essa transação, precisamos interagir com as duas tabelas e correlacionar elas
            $pdo->beginTransaction();

            // primeiro, inserimos os dados na tabela pessoa (que é a tabela pai e origina a chave primária da tabela paciente)
            $stmt1 = $pdo->prepare(
                <<<SQL
                INSERT INTO pessoa (nome, sexo, email)
                VALUES (?, ?, ?)
                SQL
            );

            // executa o primeiro statement
            $stmt1->execute([$nome, $sexo, $email]);

            // após inserir na tabela pessoa, precisamos resgatar o id da pessoa que acabamos de inserir
            // esse id será utilizado para relacionar as tabelas, por que ele é a chave primária em ambas e chave estrangeira na tabela paciente
            $idPessoa = $pdo->lastInsertId();

            // agora, inserimos os dados na tabela paciente, que é a tabela filha e possui os dados específicos do paciente, além da chave estrangeira idPessoa
            $stmt2 = $pdo->prepare(
                <<<SQL
                INSERT INTO paciente (peso, altura, tipoSanguineo, idPessoa)
                VALUES (?, ?, ?, ?)
                SQL
            );

            // executa o segundo statement
            $stmt2->execute([$peso, $altura, $tipoSanguineo, $idPessoa]);

            // Efetiva as operações
            $pdo->commit();
        } catch (Exception $e) {
            // Caso ocorra alguma falha nas operações da transação, a operação
            // rollback irá desfazer as operações que eventualmente tenham sido feitas,
            // voltando o BD ao estado em que se encontrava antes da chamada
            // de beginTransaction.
            $pdo->rollBack();
            throw $e;
        }

        // retorna o nome do novo paciente criado
        return $nome;
    }

    static function GetFirst30($pdo)
    {
        // Neste exemplo não é necessário utilizar prepared statements
        // porque não há a possibilidade de inj. de S Q L, 
        // pois nenhum parâmetro do usuário é utilizado na query SQL. 
        $stmt = $pdo->query(
            <<<SQL
            SELECT paciente.idPessoa, nome, sexo, email, peso, altura, tipoSanguineo
            FROM paciente INNER JOIN pessoa ON paciente.idPessoa = pessoa.id
            LIMIT 30
            SQL
        );

        // Resgata os dados dos clientes como um array de objetos
        $arrayPacientes = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $arrayPacientes;
    }
}