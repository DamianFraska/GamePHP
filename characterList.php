<?php
// include "login.php";
include "helpers/classes.php";

session_start();

$database = new Database();
$userId = $_SESSION['userId'];
$characters = $database->getCharacters($userId);

if (!$characters)
{
    header('Location: ' . 'createCharacter.php');
}

?>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Rock Paper Scisor Dark Souls edition</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <link href="main2.css" rel="stylesheet">
    </head>
    <body>
        <div class="col-12 ramka text-center">
            <form method="POST" action="main2.php">        
                <label for="Names">Name:</label>

                <select name="names" id="names">
                <?php foreach($characters as $character){
                    echo '<option value="' . $character['id'] . '">' . $character['name'] . '</option>';
                }
                ?>
                <input type="submit" value="Log In" name="zaloguj">
                </select>
            </form>  
        </div>
        <div class="col-12 ramka text-center">
            <form action="createCharacter.php">
                <input type="submit" value="Create new character" />
            </form>
        </div>
    </body>
</html>