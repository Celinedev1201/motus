<?php

class GameController
{
    public static function show(): void
    {
        if (!isset($_SESSION['user_id'])) {
            Flight::redirect('/login');
            return;
        }

        $difficulty = $_GET['difficulty'] ?? 'facile';

        if (!in_array($difficulty, ['facile', 'moyen', 'difficile'])) {
            $difficulty = 'facile';
        }

        if (
            !isset($_SESSION['word']) ||
            !isset($_SESSION['difficulty']) ||
            $_SESSION['difficulty'] !== $difficulty
        ) {
            $wordModel = new Word();

            $word = $wordModel->getRandomWord($difficulty);

            if (!$word) {
                die('Aucun mot trouvé pour cette difficulté.');
            }

            $_SESSION['word_id'] = $word['id'];
            $_SESSION['word'] = $word['word'];
            $_SESSION['difficulty'] = $difficulty;
            $_SESSION['attempts'] = 0;
        }

        $page = 'game';

        require_once __DIR__ . '/../views/main.php';
    }

    public static function restart(): void
    {
        unset($_SESSION['word_id']);
        unset($_SESSION['word']);
        unset($_SESSION['attempts']);

        $difficulty = $_GET['difficulty'] ?? 'facile';

        if (!in_array($difficulty, ['facile', 'moyen', 'difficile'])) {
            $difficulty = 'facile';
        }

        Flight::redirect('/game?difficulty=' . $difficulty);
    }
}