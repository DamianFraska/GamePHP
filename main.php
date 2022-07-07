<?php

include 'helper/functions.php';

session_start();

$database = new Database();
$character = $database->getCharacter($_SESSION['userId'], $_POST['names']);







$score = file_get_contents('score.txt');
$life = file_get_contents('life.txt');
$opponentLife = file_get_contents('opponentLife.txt');


// $name = $_SESSION['name'] ?? $_POST['name'] ?? 'Unknown player';
// $_SESSION['name'] = $name;

$playerMove = $_POST['playerMove'] ?? [];
$opponentMove = array("Paper", "Scissors", "Rock");
$opponentMoveRand = $opponentMove[array_rand($opponentMove)];
$result = null;
$opponentIMGArray = array("0", "1", "2", "3", "4", "5");
$opponentIMG = file_get_contents('opponentIMG.txt');


if ($playerMove) {
    $playerMove = array_keys($playerMove);
    $playerMove = array_pop($playerMove);
    $result = rockPaperScissor($playerMove, $opponentMoveRand);
    $battleMSG = countScoreLife($result);
}

$score = file_get_contents('score.txt');
$life = file_get_contents('life.txt');
$opponentLife = file_get_contents('opponentLife.txt');

if ($life === '0') {
    header('Location: ' . '/gameover.php');
}
if ($opponentLife === '0') {
    $opponentIMG = file_get_contents('opponentIMG.txt');
    file_put_contents("opponentIMG.txt", $opponentIMG + 1);
    $opponentIMG = file_get_contents('opponentIMG.txt');
    file_put_contents("opponentLife.txt", "3");
    $opponentLife = file_get_contents('opponentLife.txt');
}

?>


<html>

<head>
    <h1>
        Wynik:
        <?php echo $score; ?>
    </h1>
    <h2>
        <?php echo $name; ?><br>
        HP:
        <?php echo $life ?>
    </h2>
    <h3>
        Opponent<br>
        HP:
        <?php echo $opponentLife; ?>
    </h3>
    <h3>
        <img src="opponentIMG/<?PHP echo $opponentIMGArray[$opponentIMG] . '.jpg'; ?>" alt="Opponent" width="200" height="300">
    </h3>
</head>

<body>
    <form method="POST">
        <input type="hidden" value="<?php echo $name ?>" name="name">
        <button type="submit" name="playerMove[rock]">Rock</button>
        <button type="submit" name="playerMove[paper]">Paper</button>
        <button type="submit" name="playerMove[scissors]">Scissors</button>
    </form>

    <h1>
        Battle Log:
    </h1>
    <h2>
        <?php echo battleLog($result)
        ?>
    </h2>
</body>

</html>