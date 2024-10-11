<?php


# esse arquivo tem a lógica de autenticação de um usuário, realizando a consulta no banco em busca de correspondência e autenticando senha
# se o login for bem-sucedido, redireciona para a página home.html, caso contrário, volta para a página index.html
function checkLogin($pdo, $email, $senha)
{
  try {
    // Neste caso utilize prepared statements para prevenir
    // inj. de S Q L, pois precisamos inserir dados fornecidos
    // pelo usuário na consulta SQL (o email do usuário)
    $stmt = $pdo->prepare(
      <<<SQL
      SELECT senhaHash
      FROM cliente
      WHERE email = ?
      SQL
    );
    $stmt->execute([$email]);
    $senhaHash = $stmt->fetchColumn();
    if (!$senhaHash) return false; // nenhum resultado (email não encontrado)

    return password_verify($senha, $senhaHash);
  } 
  catch (Exception $e) {
    exit('Falha inesperada: ' . $e->getMessage());
  }
}

require "../conexaoMysql.php";
$pdo = mysqlConnect();

$email = $_POST["email"] ?? "";
$senha = $_POST["senha"] ?? "";

if (checkLogin($pdo, $email, $senha))
  header("location: home.html");
else
  header("location: index.html");
