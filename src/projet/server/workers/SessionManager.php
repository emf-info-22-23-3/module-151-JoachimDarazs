<?php
class SessionManager
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); // Démarre la session si elle n'est pas active
        }
    }

    // Stocke les informations de l'utilisateur dans la session
    public function openSession($user): void
    {
        $_SESSION['user'] = $user;
    }

    // Vérifie si l'utilisateur est connecté
    public function isConnected(): bool
    {
        return isset($_SESSION['user']);
    }

    // Détruit la session
    public function destroySession(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }

    // Retourne l'utilisateur actuel
    public function currentUser()
    {
        return $_SESSION['user'] ?? null;
    }

    // Retourne l'ID de la session
    public function getSessionId(): string
    {
        return session_id();
    }
}
?>
