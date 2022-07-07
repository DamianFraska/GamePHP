<?php
class Database 
{

    private PDO $connection;

    public function __construct()
    {
        $dsn = 'mysql:dbname=phpgame;host=127.0.0.1';
        $user = 'root';
        $password = '';

        $this->connection = new PDO($dsn, $user, $password);
    }

    public function getHistory(): array
    {
        $sql = 'SELECT result FROM score_history';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }

    public function addToHistory(string $result): void
    {
        $sql = 'INSERT INTO score_history (result) VALUES (:result)';
        $statement = $this->connection->prepare($sql);
        $statement->execute(['result'=>$result]);
    }
}

$database = new Database();
$result = $database->getHistory();
$database->addToHistory('win');
$result2 = $database->getHistory();