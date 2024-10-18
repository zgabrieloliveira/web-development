<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();


// vai receber na URL do navegador, então é GET
$modelo = $_GET['modelo'] ?? ''; 

try {

    // "modelo, ano, cor e quilometragem de todos os veículos do modelo em questão cadastrados"
    $sql = <<<SQL
    SELECT DISTINCT *
    FROM veiculo
    WHERE modelo = ?
    SQL;
  
  // como vai receber dados do usuário, é mais seguro utilizar prepared statement
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$modelo]);
  $veiculos = $stmt->fetchAll(PDO::FETCH_ASSOC); // retorna todos os resultados em um array
  echo json_encode($veiculos); // converte o array para JSON e envia ao usuário
} 

catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}

