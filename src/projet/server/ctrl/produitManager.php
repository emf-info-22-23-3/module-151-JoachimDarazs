<?php

/**
 * Démarre une session si aucune session n'est déjà active.
 */

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
/**
 * Inclusion des fichiers nécessaires pour la gestion des produits et des sessions.
 */
include_once('../workers/ProduitBDManager.php');
include_once('../workers/SessionManager.php');
/**
 * Création des objets nécessaires pour interagir avec la base de données des produits et pour gérer les sessions utilisateur.
 */
$produitBD = new ProduitBDManager();
$sessionManager = new SessionManager();

/**
 * Vérifie si une méthode HTTP est présente dans la requête pour déterminer l'action à effectuer.
 * Cela permet de gérer les différentes actions en fonction de la méthode (GET, POST, PUT, DELETE).
 */
if (isset($_SERVER['REQUEST_METHOD'])) {

	/**
	 * Méthode GET : Récupère et renvoie la liste des produits au format XML.
	 */
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {

		echo $produitBD->getProduitsXML();
	}
	/**
	 * Méthode POST : Permet l'ajout d'un produit si l'utilisateur est administrateur.
	 * Vérifie que l'utilisateur a les droits nécessaires et que les informations envoyées sont valides.
	 */
	else if ($_SERVER['REQUEST_METHOD'] == 'POST') {


		if ($sessionManager->currentUser() === 'admin') {
			/**
			 * Vérifie que l'action est 'add' et que toutes les données nécessaires pour ajouter un produit sont présentes.
			 */
			if (isset($_POST['action']) && $_POST['action'] === 'add') {
				if (
					isset($_POST['nom']) && isset($_POST['description']) && isset($_POST['lien_Image'])
					&& isset($_POST['prix']) && isset($_POST['FK_Categorie']) && isset($_POST['FK_Marque'])
				) {
					$data = [
						'nom'          => $_POST['nom'],
						'description'  => $_POST['description'],
						'lien_Image'   => $_POST['lien_Image'],
						'prix'         => $_POST['prix'],
						'FK_Categorie' => $_POST['FK_Categorie'],
						'FK_Marque'    => $_POST['FK_Marque']
					];
					/**
					 * Validation des données reçues avant de les insérer dans la base de données.
					 * Chaque champ est vérifié pour s'assurer qu'il respecte les critères de validation (type, taille, etc.).
					 */
					foreach ($data as $key => $value) {
						switch ($key) {
							case 'nom':
								if (!is_string($value) || strlen($value) > 50) {
									http_response_code(400);
									echo "<result>Erreur : nom doit être une chaîne (max 50)</result>";
								}
								break;

							case 'description':
							case 'lien_Image':
								if (!is_string($value) || strlen($value) > 500) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être une chaîne (max 500)</result>";
								}
								break;

							case 'prix':
								if (!is_numeric($value) || floatval($value) < 0) {
									http_response_code(400);
									echo "<result>Erreur : prix doit être un nombre décimal positif</result>";
								}
								break;

							case 'FK_Categorie':
							case 'FK_Marque':
								if (!ctype_digit($value)) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être un entier</result>";
								}
								break;
						}
					}

					/**
					 * Si toutes les validations passent, on ajoute le produit dans la base de données.
					 * Une réponse est envoyée pour indiquer si l'ajout a réussi ou échoué.
					 */

					$success = $produitBD->addProduits(
						$data['nom'],
						$data['description'],
						$data['lien_Image'],
						$data['prix'],
						$data['FK_Categorie'],
						$data['FK_Marque']
					);
					//created
					if ($success) {
						http_response_code(200);
						echo "<result>Produit ajouté avec succès</result>";
						//erreur interne au serveur 
					} else {
						http_response_code(500);
						echo "<result>Erreur lors de l'ajout du produit</result>";
					}
				} else {
					http_response_code(400);
					echo '<result>Erreur : Tous les champs sont requis</result>';
				}
			} else {
				http_response_code(403);
				echo '<result>Accès refusé</result>';
			}
		}

		/**
		 * Méthode PUT : Permet la modification d'un produit existant si l'utilisateur est administrateur.
		 * Vérifie que l'action est 'modify' et que toutes les données nécessaires sont présentes et valides.
		 */
	} else if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
		if ($sessionManager->currentUser() === 'admin') {
			parse_str(file_get_contents("php://input"), $vars);

			if (isset($vars['action']) && $vars['action'] === 'modify') {
				if (
					isset($vars['id']) && $vars['nom'] && isset($vars['description']) && isset($vars['lien_Image'])
					&& isset($vars['prix']) && isset($vars['FK_Categorie']) && isset($vars['FK_Marque'])
				) {
					$data = [
						'id'		   => $vars['id'],
						'nom'          => $vars['nom'],
						'description'  => $vars['description'],
						'lien_Image'   => $vars['lien_Image'],
						'prix'         => $vars['prix'],
						'FK_Categorie' => $vars['FK_Categorie'],
						'FK_Marque'    => $vars['FK_Marque']
					];
					/**
					 * Validation des données reçues pour la modification du produit avant de les enregistrer dans la base de données.
					 */
					foreach ($data as $key => $value) {
						switch ($key) {
							case 'id':
								if (!is_numeric($value)) {
									http_response_code(400);
									echo "<result>Erreur : id doit etre un nombre</result>";
								}
								break;

							case 'nom':
								if (!is_string($value) || strlen($value) > 50) {
									http_response_code(400);
									echo "<result>Erreur : nom doit être une chaîne (max 50)</result>";
								}
								break;

							case 'description':
							case 'lien_Image':
								if (!is_string($value) || strlen($value) > 500) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être une chaîne (max 500)</result>";
								}
								break;

							case 'prix':
								if (!is_numeric($value) || floatval($value) < 0) {
									http_response_code(400);
									echo "<result>Erreur : prix doit être un nombre décimal positif</result>";
								}
								break;

							case 'FK_Categorie':
							case 'FK_Marque':
								if (!ctype_digit($value)) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être un entier</result>";
								}
								break;
						}
					}

					/**
					 * Si toutes les validations sont correctes, on modifie le produit dans la base de données.
					 */
					$success = $produitBD->modifyProduit(
						$data["id"],
						$data['nom'],
						$data['description'],
						$data['lien_Image'],
						$data['prix'],
						$data['FK_Categorie'],
						$data['FK_Marque']
					);
					//created
					if ($success) {
						http_response_code(200);
						echo "<result>Produit modifié avec succès</result>";
						//erreur interne au serveur 
					} else {
						http_response_code(500);
						echo "<result>Erreur lors de l'ajout du produit</result>";
					}
				} else {
					http_response_code(400);
					echo '<result>Erreur : Tous les champs sont requis</result>';
				}
			}
		} else {
			http_response_code(403);
			echo '<result>Accès refusé</result>';
		}
		/**
		 * Méthode DELETE : Permet la suppression d'un produit si l'utilisateur est administrateur.
		 * Vérifie que l'action est 'delete' et que l'id du produit est fourni.
		 */
	} else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
		if ($sessionManager->currentUser() === 'admin') {
			parse_str(file_get_contents("php://input"), $vars);
			if (isset($vars['action']) && $vars['action'] === 'delete') {
				if (isset($vars['id'])) {

					$success = $produitBD->deleteProduct($vars['id']);
					if ($success) {
						http_response_code(200);
						echo "<result>Produit supprimé avec succès</result>";
						//erreur interne au serveur 
					} else {
						http_response_code(500);
						echo "<result>Erreur lors de la suppression du produit</result>";
					}
				} else {
					http_response_code(400);
					echo '<result>Erreur : L id du produit n est pas fournit </result>';
				}
			}
		} else {
			http_response_code(403);
			echo '<result>Accès refusé</result>';
		}
	}
}
