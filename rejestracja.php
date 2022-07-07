<?php

include 'helpers/functions.php';

$database = new Database();
$password = $_POST["password"];
$password2 = $_POST["password2"];
if($password !== $password2){
    header('Location: ' . '/rejestracja.html');
}
$database->registerUser($_POST["login"], $password);    
//TODO:: verify do insert;
header('Location: ' . '/createCharacter.php');
?>