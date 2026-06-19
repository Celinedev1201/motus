<?php

class Database
{
    private static ?PDO $pdo = null;
    private static bool $envLoaded = false;

    private static function loadEnv(): void
    {
        if (!self::$envLoaded) {
            $dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
            $dotenv->safeLoad();

            self::$envLoaded = true;
        }
    }

    public static function getConnection(): PDO
    {
        self::loadEnv();

        if (self::$pdo === null) {

            self::$pdo = new PDO(
                "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
                $_ENV['DB_USER'],
                $_ENV['DB_PASSWORD'],
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]
            );
        }

        return self::$pdo;
    }

    public static function getServerConnection(): PDO
    {
        self::loadEnv();

        return new PDO(
            "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};charset=utf8mb4",
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]
        );
    }
}