<?php

$score = file_get_contents('score.txt');
$life = file_get_contents('life.txt');
$opponentLife = file_get_contents('opponentLife.txt');

echo "GAME OVER!"."<br>";
echo "SCORE:".$score;

file_put_contents("opponentLife.txt", "3");
file_put_contents("life.txt", "3");
file_put_contents("score.txt", "0");
file_put_contents("opponentIMG.txt", "0");
?>
<html>
    <a href="/start.php">Play Again!</a>
</html>

