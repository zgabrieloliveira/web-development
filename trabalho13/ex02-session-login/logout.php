<?php

// com o algoritmo abaixo, os dados da sessão são apagados e o usuário 
// é redirecionado para a página de login, não podendo acessar conteúdo restrito sem autenticação prévia

// inicia a sessão
session_start();

// apaga as variáveis de sessão de $_SESSION
session_unset();

// destrói a sessão e as variáveis fisicamente (em arquivo)
session_destroy();

// exclui o cookie da sessão no computador do usuário
setcookie(session_name(), "", 1, "/");

// redireciona o usuário para a página de login
header('Location: index.html');
exit();