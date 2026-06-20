<?php

Flight::route('POST /register', [AuthController::class, 'register']);
Flight::route('POST /login', [AuthController::class, 'login']);
Flight::route('GET /logout', [AuthController::class, 'logout']);
Flight::route('GET /logout', function () {
    session_destroy();

    Flight::redirect('/');
});