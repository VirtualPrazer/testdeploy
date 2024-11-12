<?php
include('config.php');

class Usuario {

    public function login($user, $senha) {
        global $pdo;
        $sql = "SELECT * FROM `login` WHERE user = :user AND senha = :senha";
        $sql = $pdo->prepare($sql);
        $sql->bindValue("user", $user);
        $sql->bindValue("senha", $senha);
        $sql->execute();

        if($sql->rowCount() > 0){
            $dado = $sql->fetch();

            $_SESSION['idUser'] = $dado['id'];
            return true;

        }else {
            return false;
        }

    }
}

?>
