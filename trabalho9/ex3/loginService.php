<?php


require "usuarios.php";

class LoginService
{

    public function __construct(){}
    
    public function auth($email, $senha)
    {
        $usuarios = carregaUsuariosEmArquivo();
        for ($i = 0; $i < count($usuarios); $i++) {
            $usuario = $usuarios[$i];
            if ($usuario->email == $email) {
                $hash = htmlspecialchars($usuario->senha);
                if (password_verify($senha, $hash)) {
                    return true;
                }
            }
        }
        return false;
    }
}

?>