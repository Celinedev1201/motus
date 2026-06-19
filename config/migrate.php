<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/Database.php';

try {
    $serverPdo = Database::getServerConnection();

    $serverPdo->exec("
        CREATE DATABASE IF NOT EXISTS motus
        CHARACTER SET utf8mb4
        COLLATE utf8mb4_unicode_ci
    ");

    echo "Base motus créée ou déjà existante." . PHP_EOL;

    $pdo = Database::getConnection();

    $migrationFiles = glob(__DIR__ . '/migrations/*.php');
    sort($migrationFiles);

    foreach ($migrationFiles as $file) {
        $sql = require $file;
        $pdo->exec($sql);

        echo "Migration exécutée : " . basename($file) . PHP_EOL;
    }

    echo "Toutes les migrations sont terminées." . PHP_EOL;

} catch (PDOException $e) {
    die("Erreur migration : " . $e->getMessage() . PHP_EOL);
}