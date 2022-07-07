<?php

include "classes.php";

function rockPaperScissor($playerMove, $opponentMoveRand){
    switch ($playerMove) {
        case "rock":
            if($opponentMoveRand === "Rock"){
                return 0;
            }
            if($opponentMoveRand === "Paper"){
                return -1;
            }
            if($opponentMoveRand === "Scissors"){
                return 1;
            }
            break;
        case "paper":
            if($opponentMoveRand === "Rock"){
                return 1;
            }
            if($opponentMoveRand === "Paper"){
                return 0;
            }
            if($opponentMoveRand === "Scissors"){
                return -1;
            }
            break;
        case "scissors":
            if($opponentMoveRand === "Rock"){
                return -1;
            }
            if($opponentMoveRand === "Paper"){
                return 1;
            }
            if($opponentMoveRand === "Scissors"){
                return 0;
            }
            break;
    }
}

function countScoreLife($result){
    if($result === 1){
        $tempScore = file_get_contents('score.txt');
        file_put_contents('score.txt', $tempScore + 100);
        $tempOpponentLife = file_get_contents('opponentLife.txt');
        file_put_contents('opponentLife.txt', $tempOpponentLife - 1);
    }
    if($result === -1){
        $tempLife = file_get_contents('life.txt');
        file_put_contents('life.txt', $tempLife - 1);
    }
    if($result === 0){
        $tempScore = file_get_contents('score.txt');
        file_put_contents('score.txt', $tempScore + 10);
    }
}

function battleLog($result){
    if($result === 1){
        return "Win, You gain 100 Points";
    }
    if($result === -1){
        return "Lose, life dropped by 1";
    }
    if($result === 0){
        return "Draw, You gain 10 points";
    }

}

function loginUser(string $login, string $password): array
{

    $testArray = [
        'login' => 'jakis tam login',
        'password' => 'jakis tam password'
    ];

    //TODO: connect to db
    $database = new Database();   

    //TODO: get user from db
    $userData = $database->getUser($login);
    if(!$userData) {
        //TODO: set and display error to user 
        header('Location: ' . '/index.php');
    }
    
    //TODO: check the password
    if($password !== $userData['password']){
        header('Location: ' . '/index.php');
    }
    
    //TODO: return user data
    return $userData;
}

?>