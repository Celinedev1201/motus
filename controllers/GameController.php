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
            $_SESSION['results'] = [];
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
        unset($_SESSION['results']);

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

        $comparison = self::compareWords($guess, $_SESSION['word']);

        $_SESSION['guesses'][] = $guess;
        $_SESSION['results'][] = $comparison;
        $_SESSION['attempts']++;

        Flight::json([
            'success' => true,
            'message' => 'Mot ajouté.',
            'guesses' => $_SESSION['guesses'],
            'results' => $_SESSION['results'],
            'attempts' => $_SESSION['attempts']
        ]);
    }

    private static function compareWords(string $guess, string $secret): array
    {
        $result = [];

        for ($i = 0; $i < strlen($secret); $i++) {
            if (($guess[$i] ?? '') === $secret[$i]) {
                $result[] = 'correct';
            } elseif (str_contains($secret, $guess[$i] ?? '')) {
                $result[] = 'present';
            } else {
                $result[] = 'wrong';
            }
        }

        return $result;
    }
}