<?php
// include "login.php";
include "helpers/classes.php";

session_start();

$database = new Database();
$userId = $_SESSION['userId'];
$characters = $database->getCharacters($userId);

if (!$characters)
{
    header('Location: ' . '/createCharacter.php');
}

?>

<html>
    <head>
        
    </head>
    <body>
        <form method="POST">         
            <label for="Names">Name:</label>

            <select name="Names" id="names">
            <?php foreach($characters as $character){
                echo '<option value="' . $character['id'] . '">' . $character['name'] . '</option>';
            }
            ?>
            <input type="submit" value="Log In" name="zaloguj">
            </select>
        </form>  
    </body>
</html>