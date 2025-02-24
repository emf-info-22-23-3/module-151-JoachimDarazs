<?php
include_once('Connexion.php');



/**
 * Classe skieurBDManager
 *
 * Cette classe permet la gestion des skieurs dans la base de donnéees dans l'exercice de debuggage
 *
 */
class ProduitBDManager
{
	private $db;
	public function __construct()
	{
		$this->db = Connexion::getInstance();
	}


	public function addProduits($nom, $description, $lien_Image, $prix, $FK_Categorie, $FK_Marque)
	{

		$query = "INSERT INTO `darazsj_cimexplore`.`T_Produit` (`nom`, `description`, `lien_Image`, `prix`, `FK_Categorie`, `FK_Marque`) VALUES
		(?, ?, ?, ?, ?, ?)";


		$params = [
			htmlspecialchars((string) $nom),
			htmlspecialchars((string) $description),
			htmlspecialchars((string) $lien_Image),
			(float) $prix,
			(int) $FK_Categorie,
			(int) $FK_Marque
		];

		return $this->db->executeQuery($query, $params);
	}


	public function modifyProduit($id, $nom, $description, $lien_Image, $prix, $FK_Categorie, $FK_Marque){
		$query =	
		"UPDATE darazsj_cimexplore.T_Produit SET 
        nom = ?, 
        description = ?, 
        lien_Image = ?, 
        prix = ?, 
        FK_Categorie = ?, 
        FK_Marque = ? 
        WHERE PK_produit = ?;";

		$params = [
			
			htmlspecialchars((string) $nom),
			htmlspecialchars((string) $description),
			htmlspecialchars((string) $lien_Image),
			(float) $prix,
			(int) $FK_Categorie,
			(int) $FK_Marque,
			(int) $id
		];

		return $this->db->executeQuery($query, $params);
	}
	


	public function getAllProduits()
	{
		$query = "
					SELECT 
						p.PK_produit, 
						p.nom AS nomProduit, 
						p.description, 
						p.lien_Image, 
						p.prix, 
						c.PK_Categorie, 
						c.nom AS nomCategorie, 
						m.PK_marque, 
						m.nom AS nomMarque
					FROM T_Produit p
					JOIN T_Categorie c ON p.FK_Categorie = c.PK_Categorie
					JOIN T_marque m ON p.FK_Marque = m.PK_marque;";

		return $this->db->selectQuery($query, []);
	}

	public function deleteProduct($id)
	{
		$query = "DELETE FROM `darazsj_cimexplore`.`T_Produit` WHERE PK_produit = ?;";

		$params = [
			htmlspecialchars((int) $id)
		];
		return $this->db->executeQuery($query, $params);
	}

	public function getProduitsXML()
	{
		$produits = $this->getAllProduits();

		// Début du XML
		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<produits>';

		// Ajout des produits
		//htmlspecialchars permet de sécuriser contre les injections HTML mais aussi les erreurs XML 
		foreach ($produits as $produit) {
			$xml .= '<produit>';
			$xml .= '<idP>' . $produit['PK_produit'] . '</idP>';
			$xml .= '<nomP>' . htmlspecialchars( $produit['nomProduit']) . '</nomP>';
			$xml .= '<description>' . htmlspecialchars($produit['description']) . '</description>';
			$xml .= '<lienImage>' . htmlspecialchars($produit['lien_Image']) . '</lienImage>';
			$xml .= '<prix>' . $produit['prix'] . '</prix>';
			$xml .= '<categorie>';
			$xml .= '<id>' . $produit['PK_Categorie'] . '</id>';
			$xml .= '<nom>' . htmlspecialchars($produit['nomCategorie']) . '</nom>';
			$xml .= '</categorie>';
			$xml .= '<marque>';
			$xml .= '<id>' . $produit['PK_marque'] . '</id>';
			$xml .= '<nom>' . htmlspecialchars($produit['nomMarque']) . '</nom>';
			$xml .= '</marque>';
			$xml .= '</produit>';
		}

		// Fin du XML
		$xml .= '</produits>';

		return $xml;
	}
}
