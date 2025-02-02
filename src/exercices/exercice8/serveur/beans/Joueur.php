<?php

class Joueur
{
    private $id;
    private $name;

    private $fk_equipe;
    private $points;

    public function __construct($id, $name, $fk_equipe, $points)
    {
        $this->id = $id;
        $this->name = $name;
        $this->fk_equipe = $fk_equipe;
        $this->points = $points;

    }

    public function getId()
    {
        return $this->id;
    }
    public function getName()
    {
        return $this->name;
    }
    public function getPoints()
    {
        return $this->points;
    }
    public function getFKEquipe()
    {
        return $this->fk_equipe;
    }
    public function __toString()
    {
        return $this->name;
    }
}