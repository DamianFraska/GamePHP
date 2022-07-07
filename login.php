<?php

include 'helpers/functions.php';

session_start();

$user = loginUser($_POST['login'], $_POST['password']); 
// $user = loginUser('usertest', 'usertest'); 
$userId = $user['id'];
$_SESSION['userId'] = $userId;


header('Location: ' . '/characterList.php');
?>
