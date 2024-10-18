<?php

$cep = $_GET['cep'] ?? ''; // recebe dados da requisição GET

// verifica o CEP e retorna a cidade correspondente, no caso de não encontrar, retorna 404
// apenas Uberlândia e Patos de Minas estão disponíveis, qualquer outro CEP resulta em 404
if ($cep == '38400-100')
  echo 'Uberlândia';
else if ($cep == '38700-000')
  echo 'Patos de Minas';
else {
  http_response_code(404);
  echo "$cep is not available";
} 