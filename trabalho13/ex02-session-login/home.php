<?php

require "conexaoMysql.php"; // conexão com BD
require "sessionVerification.php"; // verifica se o usuário está logado

session_start(); // // abre a sessão criada através do login 
exitWhenNotLoggedIn(); // encerra a execução se o usuário não estiver logado
$pdo = mysqlConnect(); // conecta com BD

?>

<!DOCTYPE html>
<html lang="pt-br">

<!-- página apresentada apenas para usuários que passaram pelo login e iniciaram uma sessão -->

<head>
  <meta charset="UTF-8">
  <title>Home</title>
  <style>
    body {
      font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
      line-height: 1.5rem;
      background-image: url("images/bg2.jpg");
      background-size: cover;
      margin: 0;
    }

    main {
      width: 60%;
      background-color: #fafafa;
      border: 0.5px solid gray;
      margin: 0;
      padding: 2% 4%;

      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    main>h2 {
      color: limegreen;
    }
  </style>
</head>

<body>

  <main>
  <!-- texto personalizado com dados do usuário no objeto global SESSION -->
    <h2>Dados corretos! Bem vindo, <?php echo $_SESSION['user'] ?>!</h2>
    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Ut tenetur distinctio odio vel possimus necessitatibus
      aut ab nesciunt beatae, laudantium at alias, quaerat debitis quam labore fugit dolores amet? Temporibus.</p>
    <hr>
    <p><strong>Dica:</strong> clique em sair e posteriormente tente acessar esta página digitando manualmente 'home.php' no final da barra de endereços do navegador</p>
    <a href="logout.php">SAIR</a>
  </main>

</body>

</html>