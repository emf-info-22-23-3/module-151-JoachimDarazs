<?php

class Categorie {
    private int $pkCategorie;
    private string $nom;

    public function __construct(string $nom, int $pkCategorie) {
        $this->nom = $nom;
        $this->pkCategorie = $pkCategorie;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPkCategorie(): int {
        return $this->pkCategorie;
    }

    public function toXML(): string {
        $result = '<Categorie>';
        $result .= '<pkCategorie>' . $this->getPkCategorie() . '</pkCategorie>';
        $result .= '<nom>' . $this->getNom() . '</nom>';
        $result .= '</Categorie>';
        return $result;
    }
}
