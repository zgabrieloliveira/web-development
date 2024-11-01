<?php

require "conexaoMysql.php"; // função para se conectar com BD via PDO

// arquivo que realiza a lógica de autenticação do usuário

class LoginResult
{
  public $success;
  public $newLocation;

  function __construct($success, $newLocation)
  {
    $this->success = $success;
    $this->newLocation = $newLocation;
  }
}

// autentica dados de entrada do usuário
function checkUserCredentials($pdo, $email, $senha)
{
  // consulta dados do usuário no BD em busca de correspondência
  $sql = <<<SQL
    SELECT senhaHash
    FROM cliente
    WHERE email = ?
    SQL;

  try {
    // É necessário utilizar prepared statements por incluir
    // parâmetros informados pelo usuário
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn(); // obtém o valor da primeira coluna da linha retornada pela consulta

    if (!$senhaHash) 
      return false; // a consulta não retornou nenhum resultado (email não encontrado)

    // se hash da senha fornecida não corresponder à senha armazenada, não autentica
    if (!password_verify($senha, $senhaHash))
      return false; // email e/ou senha incorreta
      
    // email e senha corretos
    return true;
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

$pdo = mysqlConnect(); // conecta com BD

// chama função de autenticação que retorna resultado booleano e só entra nesse if se for true
if (checkUserCredentials($pdo, $email, $senha)) {
  // Define o parâmetro 'httponly' para o cookie de sessão, para que o cookie
  // possa ser acessado apenas pelo navegador nas requisições http (e não por código JavaScript).
  // Aumenta a segurança evitando que o cookie de sessão seja roubado por eventual
  // código JavaScript proveniente de ataq. X S S.
  $cookieParams = session_get_cookie_params();
  $cookieParams['httponly'] = true;
  session_set_cookie_params($cookieParams); // aplica configuração ao cookie da sessão
  
  session_start(); // inicia a sessão e cria o cookie de sessão
  $_SESSION['loggedIn'] = true; // define variável de sessão para indicar que o usuário está logado
  $_SESSION['user'] = $email; // armazena o email do usuário na sessão
  $response = new LoginResult(true, 'home.php'); // redireciona para a página home.php, pois o usuário foi autenticado
} 
else
  // caso contrário, loggedIn = false e não redireciona, assim, o usuário não vai poder 
  // acessar a página home.php enquanto não logar, em virtude da variável SESSION, que informa se o usuário está logado ou não
  $response = new LoginResult(false, ''); 

// envia json com a resposta 
header('Content-Type: application/json; charset=utf-8'); 
echo json_encode($response);