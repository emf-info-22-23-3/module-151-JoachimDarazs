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
	 /**
     * Instance de connexion à la base de données.
     * @var Connexion
     */
	private $db;
	/**
     * Constructeur de la classe.
     * Initialise la connexion à la base de données.
     */
	public function __construct()
	{
		$this->db = Connexion::getInstance();
	}

	/**
     * Ajoute un produit à la base de données.
     *
     * @param string $nom Nom du produit.
     * @param string $description Description du produit.
     * @param string $lien_Image Lien vers l'image du produit.
     * @param float $prix Prix du produit.
     * @param int $FK_Categorie Identifiant de la catégorie du produit.
     * @param int $FK_Marque Identifiant de la marque du produit.
     * @return bool Retourne `true` si l'ajout a réussi, sinon `false`.
     */
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

	 /**
     * Modifie un produit existant dans la base de données.
     *
     * @param int $id Identifiant du produit à modifier.
     * @param string $nom Nom du produit.
     * @param string $description Description du produit.
     * @param string $lien_Image Lien vers l'image du produit.
     * @param float $prix Prix du produit.
     * @param int $FK_Categorie Identifiant de la catégorie du produit.
     * @param int $FK_Marque Identifiant de la marque du produit.
     * @return bool Retourne `true` si la modification a réussi, sinon `false`.
     */
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
	

	 /**
     * Récupère la liste de tous les produits avec leurs catégories et marques.
     *
     * @return array Retourne un tableau contenant tous les produits.
     */
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
	
	

    /**
     * Supprime un produit de la base de données.
     *
     * @param int $id Identifiant du produit à supprimer.
     * @return bool Retourne `true` si la suppression a réussi, sinon `false`.
     */

	public function deleteProduct($id)
	{
		$query = "DELETE FROM `darazsj_cimexplore`.`T_Produit` WHERE PK_produit = ?;";

		$params = [
			htmlspecialchars((int) $id)
		];
		return $this->db->executeQuery($query, $params);
	}

    /**
     * Récupère la liste des produits au format XML.
     *
     * @return string Retourne une chaîne XML contenant la liste des produits.
     */
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
