<?php

class Word
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function getRandomWord(string $difficulty): array|false
    {
        $query = $this->pdo->prepare("
            SELECT *
            FROM words
            WHERE difficulty = :difficulty
            ORDER BY RAND()
            LIMIT 1
        ");

        $query->execute([
            'difficulty' => $difficulty
        ]);

        return $query->fetch();
    }
}