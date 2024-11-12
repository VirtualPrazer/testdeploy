<?php

session_start();

$host = 'localhost';
$usuario = 'root';
$senha = '';
$database = 'usuarios';

// $mysqli = mysqli_connect($host, $usuario, $senha, $database);
$pdo = new PDO("mysql:dbname=".$database."; host=".$host, $usuario, $senha);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = $pdo->query("SELECT * FROM `login`");
$sql->execute();

echo $sql->rowCount();

?>
