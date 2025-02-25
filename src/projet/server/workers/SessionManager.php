<?php
/**
 * Classe SessionManager
 *
 * Cette classe gère la session utilisateur, y compris l'ouverture, la vérification,
 * la récupération des informations et la destruction de la session.
 */
class SessionManager
{
    /**
     * Ouvre une session et stocke les informations de l'utilisateur.
     *
     * @param mixed $user Données de l'utilisateur à stocker dans la session.
     * @return void
     */
    public function openSession($user): void
    {
        $_SESSION['user'] = $user;
    }

    /**
     * Vérifie si un utilisateur est connecté.
     *
     * @return bool Retourne `true` si un utilisateur est connecté, sinon `false`.
     */
    public function isConnected(): bool
    {
        return isset($_SESSION['user']);
    }

    /**
     * Détruit la session en cours.
     *
     * @return void
     */
    public function destroySession(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_unset();
            session_destroy();
        }
    }

    /**
     * Retourne les informations de l'utilisateur actuellement connecté.
     *
     * @return mixed Retourne les informations de l'utilisateur ou `null` si aucun utilisateur n'est connecté.
     */
    public function currentUser()
    {
        //simplification du code suivant :
        // if (isset($_SESSION['user'])) {
        //     return $_SESSION['user'];
        //  } else {
        //     return null;
        //  }
        return $_SESSION['user'] ?? null;
    }

    /**
     * Retourne l'ID de la session en cours.
     *
     * @return string L'identifiant unique de la session.
     */
    public function getSessionId(): string
    {
        return session_id();
    }
}
?>
