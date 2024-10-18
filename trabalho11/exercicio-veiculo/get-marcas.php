<?php

require "conexaoMysql.php";
$pdo = mysqlConnect();

try {
  // "nomes distintos de todas as marcas de veículos existentes na tabela veículo"  
  $sql = <<<SQL
  SELECT DISTINCT marca
  FROM veiculo
  ORDER BY marca
  SQL;

  // não há risco de SQL Injection, pois não há parâmetros fornecidos pelo usuário, 
  // então query() é mais apropriado que prepared statements
  $stmt = $pdo->query($sql);
  $marcas = $stmt->fetchAll(PDO::FETCH_COLUMN);
  echo json_encode($marcas);
} 
catch (Exception $e) {
  exit('Ocorreu uma falha: ' . $e->getMessage());
}

?>