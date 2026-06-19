<?php

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/Database.php';

try {
    $pdo = Database::getConnection();
    echo "Connexion BDD OK";
} catch (PDOException $e) {
    echo "Erreur BDD : " . $e->getMessage();
}