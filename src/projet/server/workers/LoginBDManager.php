<?php
require_once("Connexion.php");
class LoginBDManager
{
    //methode qui retourne le mdp en fonction d'un user
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