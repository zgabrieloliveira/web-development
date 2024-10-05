<?php

require "loginService.php";

// Recebe os dados do formulário
$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

// Autentica o usuário
$loginService = new LoginService();
$auth = $loginService->auth($email, $senha);

if ($auth) {
    // Redireciona o navegador para a página de sucesso na autenticação
    header("location: loginSucceed.html");
} else {
    // Redireciona o navegador para a página de falha na autenticação
    header("location: loginFailed.html");
}

?>