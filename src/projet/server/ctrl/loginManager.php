<?php

/**
 * Gestion de l'authentification et des sessions utilisateur.
 *
 * Ce script permet de gérer la connexion et la déconnexion des utilisateurs via
 * des requêtes POST. Il vérifie les identifiants fournis, démarre une session
 * et retourne une réponse appropriée.
 */
if (session_status() === PHP_SESSION_NONE) {
    session_start(); 
}
require_once("../workers/LoginBDManager.php");
require_once("../workers/SessionManager.php");
/**
 * Vérifie si la requête est une requête POST.
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sessionManager = new SessionManager();

    /**
     * Vérifie si l'action demandée est "connect" (connexion utilisateur).
     */
    if (isset($_POST['action']) && $_POST['action'] === 'connect') {
        /**
         * Vérifie si les champs login et password sont présents dans la requête.
         */
        if (isset($_POST['login']) && isset($_POST['password'])) {
            $username = $_POST['login'];
            $password = $_POST['password'];

            $loginBD = new LoginBDManager();
            $result = $loginBD->checkLogin($username);
            
            /**
             * Vérifie si l'utilisateur existe dans la base de données.
             */
            if ($result != null) {
                /**
                 * Vérifie si le mot de passe fourni correspond au hash enregistré.
                 */
                if (password_verify($password, $result['password'])) {
                    $sessionManager->openSession($username);
                    echo '<result>' . $sessionManager->currentUser() . '</result>';
                    //200 OK
                    http_response_code(200);

                } else {
                    // 401 unauthorized 
                    http_response_code(401);
                    echo '<result>Mot de passe incorrect</result>';

                }
            } else {
                //code 404 Not found 
                http_response_code(404);
                echo '<result>Utilisateur non trouvé</result>';

            }
        } else {
            // code 400 Bad request
            http_response_code(400);
            echo '<result>Champs manquants</result>';

        }
    }

    /**
     * Vérifie si l'action demandée est "disconnect"
     */
    if ($_POST['action'] === 'disconnect') {
        $sessionManager->destroySession();
        echo '<result>true</result>';
        http_response_code(200);

    }
}
