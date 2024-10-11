<?php

require "../conexaoMysql.php";
$pdo = mysqlConnect(); // abrindo conexão com as credenciais do BD no infinityfree, definidas na própria função

try {
  // consulta SQL com heredoc
  $sql = <<<SQL
    SELECT nome, telefone
    FROM aluno
  SQL;

  // executando a consulta SQL com query: utilizado em SELECT, pois ele retorna um conjunto de resultados
  $stmt = $pdo->query($sql); 
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

?>
<!doctype html>
<html lang="pt-BR">

<head>
  <meta charset="utf-8">
  <!-- 1: Tag de responsividade -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hello World - Listagem de Dados em Tabela do MySQL</title>

  <!-- 2: Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <h3>Dados na tabela <b>aluno</b></h3>
    <table class="table table-striped table-hover">
      <tr>
        <th>Nome</th>
        <th>Telefone</th>
      </tr>
      <?php
      // através de fetch(), cada linha do resultado obtido pela consulta será processada
      while ($row = $stmt->fetch()) 
      {
        // pega colunas dos resultados com htmlspecialchars, evitando XSS
        $nome = htmlspecialchars($row['nome']);
        $telefone = htmlspecialchars($row['telefone']);

        // exibe resultados na tabela através de echo
        echo <<<HTML
        <tr>
          <td>$nome</td> 
          <td>$telefone</td>
        </tr>      
        HTML;
      }
      ?>
    </table>
    <a href="../index.html">Menu de opções</a>
  </div>

</body>

</html>