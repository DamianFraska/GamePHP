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

function countScoreLife(int $result, array $character, array $currentOpponenData) :array
{
    if ($result === 1) {
        $character['point'] = $character['point'] + (2 * $character['current_opponent_id']+1);
        $character['current_opponent_hp'] = $character['current_opponent_hp'] - $character['atk'];
    }
    if ($result === -1) {
        $character['hp'] = $character['hp'] - $currentOpponenData['opponent_atk'];
    }
    if ($result === 0) {
        $character['point'] = $character['point'] + (1 * $character['current_opponent_id']+1);
    }
    return $character;
}

function battleLog($result, $character, $currentOpponenData){
    if($result === 1){
        return "Win, You gain " . (2 * ($character['current_opponent_id']+1)) . " " . "Points";
    }
    if($result === -1){
        return "Lose, life dropped by " . $currentOpponenData['opponent_atk'] ;
    }
    if($result === 0){
        return "Draw, You gain " . (1 * ($character['current_opponent_id']+1))  . " " . "Points";
    }

}

function loginUser(string $login, string $password): array
{
    $database = new Database();   

    $userData = $database->getUser($login);
    if(!$userData) {
        header('Location: ' . '/index.php');
    }
    
    if($password !== $userData['password']){
        header('Location: ' . '/index.php');
    }
    
    return $userData;
}

?>