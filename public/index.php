<?php

session_start();

require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/../config/Database.php';

require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Word.php';

require_once __DIR__ . '/../controllers/AuthController.php';
require_once __DIR__ . '/../controllers/GameController.php';

Flight::route('GET /', function () {
    $page = 'home';
    require_once __DIR__ . '/../views/main.php';
});

Flight::route('GET /login', function () {
    if (isset($_SESSION['user_id'])) {
        Flight::redirect('/game');
        return;
    }

    $page = 'login';
    require_once __DIR__ . '/../views/main.php';
});

Flight::route('GET /register', function () {
    if (isset($_SESSION['user_id'])) {
        Flight::redirect('/game');
        return;
    }

    $page = 'register';
    require_once __DIR__ . '/../views/main.php';
});

require_once __DIR__ . '/../routes/auth.php';
require_once __DIR__ . '/../routes/game.php';

Flight::start();