<?php

class AuthController
{
    public static function register(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $pseudo = trim($data['pseudo'] ?? '');
        $email = trim($data['email'] ?? '');
        $password = trim($data['password'] ?? '');

        if (!$pseudo || !$email || !$password) {
            Flight::json([
                'success' => false,
                'message' => 'Tous les champs sont obligatoires'
            ]);
            return;
        }

        $userModel = new User();

        if ($userModel->findByEmail($email)) {
            Flight::json([
                'success' => false,
                'message' => 'Email déjà utilisé'
            ]);
            return;
        }

        $userModel->create($pseudo, $email, $password);

        Flight::json([
            'success' => true,
            'message' => 'Compte créé'
        ]);
    }

    public static function login(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $email = trim($data['email'] ?? '');
        $password = trim($data['password'] ?? '');

        $userModel = new User();

        $user = $userModel->findByEmail($email);

        if (!$user || !password_verify($password, $user['password'])) {
            Flight::json([
                'success' => false,
                'message' => 'Identifiants invalides'
            ]);
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['pseudo'] = $user['pseudo'];

        Flight::json([
            'success' => true,
            'message' => 'Connexion réussie'
        ]);
    }

    public static function logout(): void
    {
        session_destroy();

        Flight::redirect('/');
    }
}