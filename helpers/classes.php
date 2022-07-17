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

    public function registerUser($login, $password): void
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
    
    public function getCharacter(int $userId, int $characterId): ?array
    {
        $sql = 'SELECT * FROM characters WHERE id = :characterId AND user_id = :userId';
        $statement = $this->connection->prepare($sql);
        $statement->execute(['characterId' => $characterId, 'userId' => $userId]);
        return $statement->fetchAll()[0] ?? null;
    }

    public function updateCharacter(array $character): int
    {
        $sql = 'UPDATE characters SET name =  :name, point = :point , hp = :hp, atk = :atk, current_opponent_id = :current_opponent_id, current_opponent_hp = :current_opponent_hp WHERE id = :id';
        $statement = $this->connection->prepare($sql);
        $statement->execute([
            'name' => $character['name'], 
            'point' => $character['point'], 
            'hp' => $character['hp'], 
            'atk' => $character['atk'],
            'current_opponent_id' => $character['current_opponent_id'],
            'current_opponent_hp' => $character['current_opponent_hp'],
            'id' => $character['id']

        ]);
        
        return $statement->rowCount();
    }

    public function getOponents(): array
    {
        $sql = 'SELECT * FROM opponents';
        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement->fetchAll() ?? null;
    }

    public function createCharacter($user_id, $name)
    {
        $sql = 'INSERT INTO characters (user_id, name) VALUES (:user_id, :name);';
        $statement = $this->connection->prepare($sql);
        $statement->execute(['user_id' => $user_id, 'name' => $name]);
    }

}
