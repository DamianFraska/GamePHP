<?php

include 'helpers/functions.php';

session_start();

$database = new Database();
if(isset($_POST['names'])){
    $_SESSION['characterId'] = $_POST['names'];
}



$character = $database->getCharacter($_SESSION['userId'], $_SESSION['characterId']);
$opponents = $database->getOponents();
$name = $character['name'] ?? 'Player';
$score = $character['point'];
$life = $character['hp'];
$currentOpponenData = $opponents[$character['current_opponent_id']];
$extendedBattleLog = null;



$nextOppnent = $_POST['nextOpponent'] ?? null;
if(isset($nextOppnent)){
    $character['current_opponent_id'] = $character['current_opponent_id'] + 1;
    $database->updateCharacter($character);
    $character['current_opponent_hp'] = $currentOpponenData['opponent_hp'];
    $opponentLife = $character['current_opponent_hp'];
    $database->updateCharacter($character);
    header('Location: ' . '/main2.php');
}

$atkUp = $_POST['atkUp'] ?? null;
if(isset($atkUp)){
    if($score >= 5 * ($character['current_opponent_id'] + 1)){
        $character['atk'] = $character['atk'] + 1;
        $character['point'] = $character['point'] - 5 * ($character['current_opponent_id'] + 1);
        $database->updateCharacter($character);
        $score = $character['point'];
        $extendedBattleLog = "Atk UP! Lost " . 5 * ($character['current_opponent_id'] + 1) . " " . "Points";
    }
}

$heal = $_POST['heal'] ?? null;
if(isset($heal)){
    if($score > 10 * ($currentOpponenData['opponent_atk'] +1)){
        $character['hp'] = $character['hp'] + ($currentOpponenData['opponent_atk'] * 5);
        $character['point'] = $character['point'] - 10 * ($currentOpponenData['opponent_atk'] +1);
        $database->updateCharacter($character);
        $score = $character['point'];
        $life = $character['hp'];
        $extendedBattleLog = "Heal! Lost " . 10 * ($currentOpponenData['opponent_atk'] +1) . " " . "Points. Healed for " . ($currentOpponenData['opponent_atk'] * 5);
    }
}



$opponentName = $currentOpponenData['opponent_name'];


$database->updateCharacter($character);

$playerMove = $_POST['playerMove'] ?? [];
$opponentMove = array("Paper", "Scissors", "Rock");
$opponentMoveRand = $opponentMove[array_rand($opponentMove)];
$result = null;


if ($playerMove) {
    $playerMove = array_keys($playerMove);
    $playerMove = array_pop($playerMove);
    $result = rockPaperScissor($playerMove, $opponentMoveRand);
    $character = countScoreLife($result, $character, $currentOpponenData);   
}

$opponentLife = $character['current_opponent_hp'] ?? null;
if(!$opponentLife || $opponentLife < 1){
    $character['current_opponent_hp'] = $currentOpponenData['opponent_hp'];
    $opponentLife = $character['current_opponent_hp'];
    $extendedBattleLog = "Monster Defeated! You gain " . (10 * ($character['current_opponent_id']+1)) . " " . "Points";
    $character['point'] = $character['point'] + (10 * $character['current_opponent_id']+1);
    $database->updateCharacter($character);
    $opponentLife = $character['current_opponent_hp'];
}



$database->updateCharacter($character);
$score = $character['point'];
$life = $character['hp'];
$opponentLife = $character['current_opponent_hp'];
$opponentName = $currentOpponenData['opponent_name'];
$opponentImg = $currentOpponenData['opponent_img'];

if ($life < 1) {
    header('Location: ' . 'gameover.php');
}