<?php

// classe utilizada para retornar dados de endereço
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

$cep = $_GET['cep'] ?? ''; // recebe dados da requisição GET

// verifica o CEP e retorna o endereço correspondente, no caso de não encontrar, retorna 404

// nesse caso, cria um novo endereço com nome de rua = Av Floriano, bairro = Centro, cidade = Uberlândia
if ($cep == '38400-100')
  $endereco = new Endereco('Av Floriano', 'Centro', 'Uberlândia');
// nesse caso, cria um novo endereço com nome de rua = Rua Tiradentes, bairro = Fundinho, cidade = Uberlândia
else if ($cep == '38400-200')
  $endereco = new Endereco('Rua Tiradentes', 'Fundinho', 'Uberlândia');
// em qualquer outro CEP, retorna um endereço vazio
else {
  $endereco = new Endereco('', '', '');
}

header('Content-type: application/json'); // no header da resposta, define que conteúdo do corpo é JSON
echo json_encode($endereco); // converte o objeto de endereço para JSON e envia resposta ao cliente
