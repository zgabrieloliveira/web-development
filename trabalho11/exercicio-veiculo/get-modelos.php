<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

$marca = $_GET['marca'] ?? ''; // vai receber na URL do navegador, então é GET

try {

    // "nomes distintos de todos os modelos de veículos cadastrados para a marca em questão"
    $sql = <<<SQL
    SELECT DISTINCT modelo
    FROM veiculo
    WHERE marca = ?
    SQL;
  
  // como vai receber dados do usuário, é mais seguro utilizar prepared statement
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$marca]);
  $modelos = $stmt->fetchAll(PDO::FETCH_COLUMN); // retorna todos os resultados em um array
  echo json_encode($modelos); // converte o array para JSON e envia ao usuário
} 

catch (Exception $e) {
  exit('Falha inesperada: ' . $e->getMessage());
}

?>
