<?php
class Produit
{
    private int $pkProduit;
    private string $nom;
    private string $description;
    private string $lienImage;
    private float $prix;
    private Categorie $fkCategorie;
    private Marque $fkMarque;

    public function __construct(string $nom, string $description, string $lienImage, float $prix, Marque $fkMarque, Categorie $fkCategorie, int $pkProduit)
    {
        $this->nom = $nom;
        $this->description = $description;
        $this->lienImage = $lienImage;
        $this->prix = $prix;
        $this->fkMarque = $fkMarque;
        $this->fkCategorie = $fkCategorie;
        $this->pkProduit = $pkProduit;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getLienImage(): string
    {
        return $this->lienImage;
    }

    public function getPrix(): float
    {
        return $this->prix;
    }

    public function getPkProduit(): int
    {
        return $this->pkProduit;
    }

    public function getFkCategorie(): Categorie
    {
        return $this->fkCategorie;
    }

    public function getFkMarque(): Marque
    {
        return $this->fkMarque;
    }

    public function toXML(): string
    {
        $result = '<Produit>';
        $result .= '<pkProduit>' . $this->getPkProduit() . '</pkProduit>';
        $result .= '<nom>' . $this->getNom() . '</nom>';
        $result .= '<description>' . $this->getDescription() . '</description>';
        $result .= '<lienImage>' . $this->getLienImage() . '</lienImage>';
        $result .= '<prix>' . $this->getPrix() . '</prix>';
        $result .= '<Categorie>' . $this->getFkCategorie()->toXML() . '</Categorie>';
        $result .= '<Marque>' . $this->getFkMarque()->toXML() . '</Marque>';
        $result .= '</Produit>';
        return $result;
    }
}
