<?php
require_once("Connexion.php");
/**
 * Gestionnaire d'authentification des utilisateurs.
 * 
 * Cette classe permet de vérifier les informations de connexion des utilisateurs
 * en récupérant leur mot de passe depuis la base de données.
 */
class LoginBDManager
{
    /**
     * Vérifie les identifiants d'un utilisateur.
     * 
     * Cette méthode récupère le mot de passe hashé associé à un nom d'utilisateur donné.
     * 
     * @param string $username Le nom d'utilisateur à vérifier.
     * @return array|null Retourne un tableau contenant le mot de passe si l'utilisateur existe, sinon `null`.
     */
    function checkLogin($username)
    {
        $result = null;
        $requete = "SELECT password from T_Utilisateur where user = :username";
        $params = array(':username' => $username);
        $data = Connexion::getInstance()->selectSingleQuery($requete, $params);
        //Verfie que des données soient retourner et que le retour soit biens un tablea
        //Car si ce n'est pas un tableau il retourne une erreur et ça produit une exeption sur count()
        if ($data && is_array($data) && count($data) > 0) {
            $result = $data;
        }
        return $result;
    }
}