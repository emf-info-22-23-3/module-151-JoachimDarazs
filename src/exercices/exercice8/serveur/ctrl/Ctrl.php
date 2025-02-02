<?php

class Ctrl {
    
    private $wrk;

    public function __construct() {
        $this->wrk = new Wrk();
    }

    public function getJoueursXML($idEquipe)
    {
        $joueurs = $this->wrk->getJoueurs($idEquipe);
        
        $xml = new SimpleXMLElement('<joueurs></joueurs>');
        
        foreach ($joueurs as $joueur) {
            $joueurElement = $xml->addChild('joueur');
            $joueurElement->addChild('id', $joueur->getId());
            $joueurElement->addChild('nom', $joueur->getName());
            $joueurElement->addChild('equipe', $joueur->getFKEquipe());
            $joueurElement->addChild('points', $joueur->getPoints());
        }

        return $xml->asXML();
    }

    public function getEquipesXML()
    {
        $equipes = $this->wrk->getEquipes();
        
        $xml = new SimpleXMLElement('<equipes></equipes>');
        
        foreach ($equipes as $equipe) {
            $equipeElement = $xml->addChild('equipe');
            $equipeElement->addChild('id', $equipe->getId());
            $equipeElement->addChild('nom', $equipe->getNom());
        }

        return $xml->asXML();
    }


}