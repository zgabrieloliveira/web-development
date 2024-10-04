<?php

require "clientes.php";

// coleta os dados do formulário
$nome = $_POST["nome"] ?? "";
$cpf = $_POST["cpf"] ?? "";
$email = $_POST["email"] ?? "";
$senha = password_hash($_POST["senha"] ?? "", PASSWORD_DEFAULT);
$cep = $_POST["cep"] ?? "";
$endereco = $_POST["endereco"] ?? "";
$bairro = $_POST["bairro"] ?? "";
$cidade = $_POST["cidade"] ?? "";
$estado = $_POST["estado"] ?? "";

// Debug: Verificar se os dados estão sendo capturados corretamente
error_log("Nome: $nome");
error_log("CPF: $cpf");
error_log("Email: $email");
error_log("Senha: $senha");
error_log("CEP: $cep");
error_log("Endereço: $endereco");
error_log("Bairro: $bairro");
error_log("Cidade: $cidade");
error_log("Estado: $estado");

// cria um novo contato e acrescenta no arquivo de texto
$novoCliente = new Cliente($nome, $cpf, $email, $senha, $cep, $endereco, $bairro, $cidade, $estado);
$novoCliente->SalvaEmArquivo();

// redireciona o navegador para a página de listagem de contatos
header("location: listaClientes.php");

?>