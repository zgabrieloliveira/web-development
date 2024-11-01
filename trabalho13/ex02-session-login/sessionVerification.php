<?php

// função acessa SESSION, que contém variáveis de sessão como: se usuário está logado (loggedIn) e seu email (user)
// e verifica loggedIn
function exitWhenNotLoggedIn()
{ 
  // se loggedIn não estiver definido, redireciona para index.html
  if (!isset($_SESSION['loggedIn'])) {
    header("Location: index.html");
    exit();  
  }
}
