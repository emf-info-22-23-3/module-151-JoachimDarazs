<?php
class SessionManager
{
    // créer la session lors de la creation d'une instance
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // On stocke les informations de l'utilisateur dans la session
    public function openSession($user): void
    {
        $_SESSION['user'] = $user;
    }

    //Verifie si l'utilisateur est connecté (si une session existe pour cet user)
    public function isConnected(): bool
    {
        return isset($_SESSION['user']);
    }
    //Détruit la session en cours
    public function destroySession(): void
    {
        session_unset();
        session_destroy();
    }
    //Retourne l'utilisateur actuel
    public function currentUser()
    {
        //Si un utilisateur est connecté on retourne ses informations
        return isset($_SESSION['user']) ? $_SESSION['user'] : null;
    }
}
