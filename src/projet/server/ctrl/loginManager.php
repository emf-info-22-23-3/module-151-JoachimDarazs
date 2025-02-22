<?php 



require_once("../workers/LoginBDManager.php");
require_once("../workers/SessionManager.php");

if (isset($_SERVER['REQUEST_METHOD'])) {
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $sessionManager = new SessionManager();

    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'connect') {
            if (isset($_POST['login']) && isset($_POST['password'])) {
                $username = $_POST['login'];
                $password = $_POST['password'];
                echo 'on est la ';
                $loginBD = new LoginBDManager();
                $result = $loginBD->checkLogin($username);

                if ($result != null) {
                    if (password_verify($password, $result['password'])) {
                        $sessionManager->openSession($username);
                        echo '<result>' . $sessionManager->currentUser() . '</result>';
                       
                    }
                }
            }
            echo '<result>false</result>';
            
        }

        if ($_POST['action'] === 'disconnect') {
            $sessionManager->destroySession();
            echo '<result>true</result>';
           
        }
    }
}
}


?>
