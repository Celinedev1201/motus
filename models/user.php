<?php

class User
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function create(
        string $pseudo,
        string $email,
        string $password
    ): bool {

        $query = $this->pdo->prepare("
            INSERT INTO users (
                pseudo,
                email,
                password
            )
            VALUES (
                :pseudo,
                :email,
                :password
            )
        ");

        return $query->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => password_hash(
                $password,
                PASSWORD_DEFAULT
            )
        ]);
    }

    public function findByEmail(
        string $email
    ): array|false {

        $query = $this->pdo->prepare("
            SELECT *
            FROM users
            WHERE email = :email
            LIMIT 1
        ");

        $query->execute([
            'email' => $email
        ]);

        return $query->fetch();
    }
}