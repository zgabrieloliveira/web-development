<?php

class Endereco
{
  public $rua;
  public $bairro;
  public $cidade;

  function __construct($rua, $bairro, $cidade)
  {
    $this->rua = $rua;
    $this->bairro = $bairro;
    $this->cidade = $cidade;
  }
}

$stringJSON = file_get_contents('php://input');

// converte a string JSON em um objeto PHP correspondente
$dados = json_decode($stringJSON);

if ($dados->cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
else if ($dados->cep == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
else
  $endereco = new Endereco('', '', '');

header('Content-Type: application/json; charset=utf-8');
echo json_encode($endereco);
