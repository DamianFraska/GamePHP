<?php

include 'helpers/functions.php';

$database = new Database();
$password = $_POST["password"];
$password2 = $_POST["password2"];
if($password !== $password2){
    header('Location: ' . 'rejestracja.html');
    exit;
}
$hashPasword = password_hash($password, PASSWORD_DEFAULT);
$database->registerUser($_POST["login"], $hashPasword);    
//TODO:: verify do insert;
header('Location: ' . 'index.php');
?>