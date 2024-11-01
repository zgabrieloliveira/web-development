<?php

// função para se conectar com BD com as credenciais corretas via PDO 
function mysqlConnect()
{
  $db_host = "sql211.infinityfree.com";
  $db_username = "if0_37059328";
  $db_password = "fa4z1Brg0qoC";
  $db_name = "if0_37059328_ppi";

  $options = [
    PDO::ATTR_EMULATE_PREPARES => false, // desativa a execução emulada de prepared statements
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ];

  try {
    // conecta com BD e retorna o objeto de conexão
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name;charset=utf8mb4", $db_username, $db_password, $options);
    return $pdo;
  } 
  catch (Exception $e) {
    // se ocorrer um erro, sai do script e exibe uma mensagem com a causa do erro
    exit('Ocorreu uma falha na conexão com o MySQL: ' . $e->getMessage());
  }
}
?>
