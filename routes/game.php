<?php

Flight::route('GET /game', [GameController::class, 'show']);
Flight::route('GET /new-game', [GameController::class, 'restart']);
Flight::route('POST /guess', [GameController::class, 'guess']);