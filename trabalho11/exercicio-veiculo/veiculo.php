<?php 

class Veiculo {
    public $id;
    public $marca;
    public $modelo;
    public $ano;
    public $cor;
    public $quilometragem;

    function __construct($id, $marca, $modelo, $ano, $cor, $quilometragem) {
        $this->id = $id;
        $this->marca = $marca;
        $this->modelo = $modelo;
        $this->ano = $ano;
        $this->cor = $cor;
        $this->quilometragem = $quilometragem;
    }

}

?>
