<?php

// classe que possuirá os dados de resultantes de uma tentativa de login
class LoginResult
{
  public $isAuthorized; // booleano para indicar autenticação
  public $newLocation; // string para indicar a nova localização para redirecionamento

  function __construct($isAuthorized, $newLocation)
  {
    $this->isAuthorized = $isAuthorized;
    $this->newLocation = $newLocation;
  }
}

// recebendo dados do post 
$email = $_POST['email'] ?? ''; 
$senha = $_POST['senha'] ?? '';

// Validação simplificada para fins didáticos. Não faça isso!


// só há redirecionamento se o email for fulano@mail.com e a senha 123456
// caso contrário não há redirecionamento e uma mensagem de erro aparece abaixo dos campos

// apenas com esses dados, retorna true e a nova localização: página home com uma mensagem de sucesso
if ($email == 'fulano@mail.com' && $senha == '123456')
  $loginResult = new LoginResult(true, 'home.html');
// se os dados não corresponderem, retorna false e não envia nova localização
else
  $loginResult = new LoginResult(false, '');

// especifica que a resposta é json
header('Content-type: application/json');
echo json_encode($loginResult); // envia resposta em json com o objeto resultante da operação