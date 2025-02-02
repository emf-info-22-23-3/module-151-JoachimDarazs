<?php

class Wrk
{

    private $bdd;

    public function __construct()
    {
        $this->bdd = new PDO('mysql:host=mysql;dbname=hockey_stats', 'root', 'root');
    }

    public function getJoueurs($idEquipe)
    {
        $reponse = $this->bdd->prepare('SELECT * FROM t_joueur WHERE FK_equipe = '.$idEquipe);
        $reponse->execute();
        $joueurs = array();
        while ($joueur = $reponse->fetch()) {
            array_push($joueurs, new Joueur ($joueur['PK_joueur'], $joueur['Nom'], $joueur['FK_equipe'], $joueur['Points']));
        }
        $reponse->closeCursor();
        return $joueurs;
    }
    public function getEquipes()
    {
        $reponse = $this->bdd->prepare('SELECT * FROM t_equipe');
        $reponse->execute();
        $equipes = array();
        while ($equipe = $reponse->fetch()) {
            array_push($equipes, new Equipe($equipe['PK_equipe'], $equipe['Nom']));
        }
        $reponse->closeCursor();
        return $equipes;
    }

}

?>