<?php
require_once './wrk/Wrk.php';
require_once './beans/Equipe.php';
require_once './beans/Joueur.php';
require_once './ctrl/Ctrl.php';

$ctrl = new Ctrl();

if($_GET['action'] == "equipe")
{
	$equipes = $ctrl->getEquipesXML();
    echo $equipes;
}

if($_GET['action'] == "joueur")
{
    $joueurs = $ctrl->getJoueursXML($_GET['equipeId']);
    echo $joueurs;
}