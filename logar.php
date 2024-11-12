<?php
include_once("config.php");

if (isset($_POST['user']) && !empty($_POST['user']) && isset($_POST['senha']) && !empty($_POST['senha'])) {
    require 'config.php';
    require 'Usuario.class.php';

    $u = new Usuario();

    $usuario = addslashes($_POST['user']);
    $senha = addslashes($_POST['senha']);

    if($u->login($usuario, $senha) == true){
        if(isset($_SESSION['idUser'])){
            header("Location: inserir_anuncio.php");
        }

    } else {
        header("Location: login.php");
        exit;
    }

} else {
    header("Location: login.php");
    exit;
}

?>
