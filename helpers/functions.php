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

function countScoreLife(int $result, array $character) :array
{
    if ($result === 1) {
        $character['point'] = ++$character['point'];
    }
    if ($result === -1) {
        $character['hp'] = --$character['hp'];
    }
    return $character;
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