<?php
include 'main.php'
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rock Paper Scisor Dark Souls edition</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link href="main2.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid">
        <div class="col-12">
            <div class="row">
                <div class="col-12 ramka text-center">
                    Points:<br>
                    <?php echo $score; ?><br>
                    Upgrade:<br>
                    <?php if($score >= 5 * ($character['current_opponent_id'] + 1)){
                        echo '
                    <form method="POST">
                        <button type="submit" name="atkUp">+1ATK (cost ' . 5 * ($character['current_opponent_id'] + 1) . 'ptk)</button>
                    </form>';
                    }
                    ?>
                    <?php if($score >= 10 * ($currentOpponenData['opponent_atk'] +1)){
                        echo '
                    <form method="POST">
                        <button type="submit" name="heal">Heal (cost ' . 10 * ($currentOpponenData['opponent_atk'] +1) . 'ptk)</button>
                    </form>';
                    }
                    ?>
                    <button>Lifesteal ability (WIP)</button>
                </div>
            </div>
            <div class="row">
                <div class="col-2 ramka">
                    <h1>
                        Stats:
                    </h1>
                    <h2>
                        HP:<?php echo $character['hp'];?><br>
                        ATK:<?php echo $character['atk'];?><br>
                    </h2>
                </div>
                <div class="col-2 ramka fontpx30 text-center">
                    <?php echo $name; ?><br>
                    <img src="opponentIMG/1.jpg" alt="Opponent" width="200" height="300">
                </div>
                <div class="col-4 vs ramka text-center">
                    VS<br>
                    <form method="POST">
                        <button type="submit" name="playerMove[rock]">Rock</button>
                        <button type="submit" name="playerMove[paper]">Paper</button>
                        <button type="submit" name="playerMove[scissors]">Scissors</button>
                    </form> 
                    <br>
                    <?php if($currentOpponenData['opponent_id'] < count($opponents) - 1){ echo '
                    <form method="POST">
                        <button type="submit" name="nextOpponent">Next Opponent?</button>
                    </form>';
                    } ?>
                </div>
                <div class="col-2 ramka fontpx30 text-center">
                <?php echo $opponentName;?><br>
                    <img src="opponentIMG/<?php echo $opponentImg;?>" alt="Opponent" width="200" height="300">
                </div>
                <div class="col-2 ramka">
                    <h1>
                        Stats:
                    </h1>
                    <h2>
                        HP:<?php echo $opponentLife;?><br>
                        ATK:<?php echo $currentOpponenData['opponent_atk'];?><br>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-12 ramka text-center">
                    <h1>
                        Battle Log:<br>
                    </h1>
                    <h2>
                        <?php echo battleLog($result, $character, $currentOpponenData) ?><br>
                        <?php echo $extendedBattleLog; ?>
                    </h2>
                </div>
            </div>
        </div>
    </div>
</body>

</html>