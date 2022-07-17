<?php
include 'helpers/functions.php';

session_start();

$userId = $_SESSION['userId'];
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
            <form method="POST" action="createCharacter.php">
                <b>Podaj imie postaci:</b> <input type="text" name="createCharacter"><br>
                <input type="submit" value="Utwórz Postać" name="create">
            </form>
        </div>
        <div class="col-12 ramka text-center">
            <form action="characterList.php">
                <input type="submit" value="Character list" />
            </form>
        </div>
    </body>

</html>

<?php
$characterName = $_POST['createCharacter'] ?? 'Player';
$database = new Database();
$characterPost = $_POST['createCharacter'] ?? null;
if ($characterPost) {
    $createCharacter = $database->createCharacter($userId, $characterName);
    header('Location: ' . 'characterList.php');
}

?>