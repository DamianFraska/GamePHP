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

    public function registerUser($login, $password)
    {
        $sql = 'INSERT INTO users (login, password) VALUES (:login, :password);';
        $statement = $this->connection->prepare($sql);
        $statement->execute(['login' => $login, 'password' => $password]);
    }

    public function getUser($login): ?array
    {
        $sql = 'SELECT * FROM users WHERE login = :login';
        $statement = $this->connection->prepare($sql);
        $statement->execute(['login' => $login]);
        return $statement->fetchAll()[0] ?? null;
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
        $statement->execute(['result' => $result]);
    }

    public function getCharacters(int $userId): array
    {
        $sql = 'SELECT * FROM characters WHERE user_id = :userId';
        $statement = $this->connection->prepare($sql);
        $statement->execute(['userId' => $userId]);
        return $statement->fetchAll();
    }
    
    public function getCharacter(int $characterId): ?array
    {
        $sql = 'SELECT * FROM characters WHERE id = :characterId';
        $statement = $this->connection->prepare($sql);
        $statement->execute(['characterId' => $characterId]);
        return $statement->fetchAll()[0] ?? null;
    }

}
