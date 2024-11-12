<?php

if(!isset($_SESSION)) {
   session_start();
}

if(!isset($_SESSION['idUser'])) {
    die("<h1>Você não pode acessar esta página porque não está logado.</h1><p><a href=\"login.php\">Entrar</a></p>");
}


?>