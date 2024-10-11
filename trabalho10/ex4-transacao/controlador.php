<?php

require "../conexaoMysql.php";
require "cliente.php";
require "paciente.php";

// resgata a ação a ser executada
$acao = $_GET['acao'];

// conecta ao servidor do MySQL
$pdo = mysqlConnect();

switch ($acao) {

  case "adicionarCliente":
    //--------------------------------------------------------------------------------------    
    $nome = $_POST["nome"] ?? "";
    $cpf = $_POST["cpf"] ?? "";
    $email = $_POST["email"] ?? "";
    $senha = $_POST["senha"] ?? "";
    $dataNascimento = $_POST["dataNascimento"] ?? "";
    $estadoCivil = $_POST["estadoCivil"] ?? "";
    $altura = $_POST["altura"] ?? "";

    // Resgata os dados do endereço do cliente
    $cep = $_POST["cep"] ?? "";
    $logradouro = $_POST["logradouro"] ?? "";
    $bairro = $_POST["bairro"] ?? "";
    $cidade = $_POST["cidade"] ?? "";

    // gera o hash da senha
    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    try {
      // Insere os dados nas tabelas correlacionadas, cliente e enderecoCliente, utilizando transação
      Cliente::Create($pdo, $nome, $cpf, $email, $senhaHash, $dataNascimento, $estadoCivil, $altura, 
        $cep, $logradouro, $bairro, $cidade);
      header("location: clientes.html");
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  case "listarClientes":
    //--------------------------------------------------------------------------------------
    try {
      $arrayProdutos = Cliente::GetFirst30($pdo);
      header('Content-Type: application/json; charset=utf-8');
      echo json_encode($arrayProdutos);
    } catch (Exception $e) {
      throw new Exception($e->getMessage());
    }
    break;

  case "adicionarPaciente":
    $nome = $_POST["nome"] ?? "";
    $sexo = $_POST["sexo"] ?? "";
    $email = $_POST["email"] ?? "";
    $peso = $_POST["peso"] ?? "";
    $altura = $_POST["altura"] ?? "";
    $tipoSanguineo = $_POST["tipoSanguineo"] ?? "";
    try {
      $nomePaciente = Paciente::Create($pdo, $nome, $sexo, $email, $peso, $altura, $tipoSanguineo);
      echo "$nomePaciente adicionado aos pacientes!";
    } catch (Exception $e) {
      echo "Erro ao adicionar paciente: " . $e->getMessage();
    }
    break;
      
    //-----------------------------------------------------------------
  default:
    exit("Ação não disponível");
}
