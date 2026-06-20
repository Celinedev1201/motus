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
            $_SESSION['guesses'] = [];
        }

        $page = 'game';

        require_once __DIR__ . '/../views/main.php';
    }

    public static function restart(): void
    {
        unset($_SESSION['word_id']);
        unset($_SESSION['word']);
        unset($_SESSION['attempts']);
        unset($_SESSION['guesses']);

        $difficulty = $_GET['difficulty'] ?? 'facile';

        if (!in_array($difficulty, ['facile', 'moyen', 'difficile'])) {
            $difficulty = 'facile';
        }

        Flight::redirect('/game?difficulty=' . $difficulty);
    }

    public static function guess(): void
    {
        if (!isset($_SESSION['user_id'])) {
            Flight::json([
                'success' => false,
                'message' => 'Vous devez être connecté.'
            ]);
            return;
        }

        $data = json_decode(file_get_contents('php://input'), true);

        $guess = strtoupper(trim($data['guess'] ?? ''));

        if ($guess === '') {
            Flight::json([
                'success' => false,
                'message' => 'Veuillez entrer un mot.'
            ]);
            return;
        }

        $_SESSION['guesses'][] = $guess;
        $_SESSION['attempts']++;

        Flight::json([
            'success' => true,
            'message' => 'Mot ajouté.',
            'guesses' => $_SESSION['guesses'],
            'attempts' => $_SESSION['attempts']
        ]);
    }
}