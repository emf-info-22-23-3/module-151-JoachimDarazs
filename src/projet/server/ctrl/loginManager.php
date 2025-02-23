<?php
require_once("../workers/LoginBDManager.php");
require_once("../workers/SessionManager.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $sessionManager = new SessionManager();

    if (isset($_POST['action']) && $_POST['action'] === 'connect') {

        if (isset($_POST['login']) && isset($_POST['password'])) {
            $username = $_POST['login'];
            $password = $_POST['password'];

            $loginBD = new LoginBDManager();
            $result = $loginBD->checkLogin($username);
            // verification de chaque possible 
    
            if ($result != null) {
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

    if ($_POST['action'] === 'disconnect') {
        $sessionManager->destroySession();
        echo '<result>true</result>';
        http_response_code(200);
        
    }
}
