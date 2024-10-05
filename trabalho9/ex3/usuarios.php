<?php

class Usuario
{
  public $email;
  public $senha;

  function __construct($email, $senha)
  {
    $this->email = $email;
    $this->senha = $senha;
  }

  public function SalvaEmArquivo()
  {
    // Abre o arquivo de texto para escrita de conteúdo no final
    $arq = fopen("usuarios.txt", "a");

    // Neste exemplo os dados são armazenados de maneira simplificada,
    // no formato textual com campos separados por ponto-e-vírgula.
    fwrite($arq, "\n{$this->email};{$this->senha}");

    // Fecha o arquivo de texto.
    fclose($arq); 
  }
}

// Carrega as informações dos contatos do arquivo de texto
// e retorna um array de objetos correspondente
function carregaUsuariosEmArquivo()
{
  $arrayUsers = [];
  
  // Abre o arquivo contatos.txt para leitura
  $arq = fopen("usuarios.txt", "r");
  if ( !$arq )
    return $arrayUsers;

  // Le os dados do arquivo, linha por linha, e armazena no vetor $contatos
  while (!feof($arq)) {
    // fgets lê uma linha de texto do arquivo
    $user = fgets($arq); 
    
    // Separa dados na linha utilizando o ';' como separador
    list($email, $senha) = array_pad(explode(';', $user), 2, null);

    // Cria novo objeto representado o contato e adiciona no final do array
    $novoUser = new Usuario($email, $senha);
    $arrayUsers[] = $novoUser;
  }
      
  // Fecha o arquivo
  fclose($arq);  
  return $arrayUsers;
}

?>