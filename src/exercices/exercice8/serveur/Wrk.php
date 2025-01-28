<?php

    class Wrk{

        public function __construct(){
        }

    public function getEquipe(){
        $bdd = new PDO('mysql:host=mysql;dbname=nomDB', 'root', 'root');
        $reponse = $bdd->prepare('SELECT * from t_equipe');
        $reponse->execute();
        $equipes= array();
        while ($data=$reponse->fetch())
        {	
            array_push($equipes, new Equipe($data['PK_equipe'], $data['Nom']));              

        }
        $reponse->closeCursor();
        return $equipes;
    }
	
}

?>
