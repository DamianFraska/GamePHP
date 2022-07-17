<?php

include 'helpers/functions.php';

session_start();

$postPassword = $_POST['password'];
$postLogin = $_POST['login'];
$database = new Database();
$user = $database->getUser($postLogin);
$hash = $user['password'];

if (password_verify($postPassword, $hash)) {
    $user = loginUser($postLogin, $hash);
    $userId = $user['id'];
    $_SESSION['userId'] = $userId;

    header('Location: ' . '/characterList.php');
} else {
    header('Location: ' . '/index.php');
}
