<?php

file_put_contents("opponentLife.txt", "3");
file_put_contents("life.txt", "3");
file_put_contents("score.txt", "0");
file_put_contents("opponentIMG.txt", "0");

?>

<html>
    <head>

    </head>
    <body>
        <form method="POST" action="main.php">
        <label for="name">Please select your player name:</label><br>
        <input type="text" id="name" name="name"><br>
        <input type="submit" value="Submit">      
        </form>
    </body>
</html>