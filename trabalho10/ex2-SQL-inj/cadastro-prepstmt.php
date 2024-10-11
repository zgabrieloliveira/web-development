<?php

require "../ex1/conexaoMysql.php";
$pdo = mysqlConnect();

$nome = $_POST["nome"] ?? "";
$telefone = $_POST["telefone"] ?? "";

try {

  // BLOCO VULNERÁVEL A SQL INJECTION: 

  // $sql = <<<SQL
  // INSERT INTO aluno (nome, telefone)
  // VALUES ('$nome', '$telefone');
  // SQL;  
  // $pdo->exec($sql);

  // BLOCO INVULNERÁVEL A SQL INJECTION:

  // não insere valores no SQL a priori, evitando SQL Injection
  $sql = <<<SQL
  INSERT INTO aluno (nome, telefone)
  VALUES (?, ?);
  SQL;  
  
  // PS mitiga vulnerabilidade a SQL Injection
  $stmt = $pdo->prepare($sql); // prepara o comando SQL sem inserir valores
  $stmt->execute([$nome, $telefone]); // insere os valores na consulta SQL e executa efetivamente

  header("location: mostra-alunos.php");
  exit();
} 
catch (Exception $e) {  
  exit('Falha ao cadastrar os dados: ' . $e->getMessage());
}
