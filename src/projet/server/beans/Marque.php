<?php
class Marque {
    private int $pkMarque;
    private string $nom;

    public function __construct(string $nom, int $pkMarque) {
        $this->nom = $nom;
        $this->pkMarque = $pkMarque;
    }

    public function getNom(): string {
        return $this->nom;
    }

    public function getPkMarque(): int {
        return $this->pkMarque;
    }

    public function toXML(): string {
        $result = '<Marque>';
        $result .= '<pkMarque>' . $this->getPkMarque() . '</pkMarque>';
        $result .= '<nom>' . $this->getNom() . '</nom>';
        $result .= '</Marque>';
        return $result;
    }
}