<?php


if (session_status() === PHP_SESSION_NONE) {
	session_start();
}
include_once('../workers/ProduitBDManager.php');
include_once('../workers/SessionManager.php');
$produitBD = new ProduitBDManager();
if (isset($_SERVER['REQUEST_METHOD'])) {
	if ($_SERVER['REQUEST_METHOD'] == 'GET') {
		
		echo $produitBD->getProduitsXML();
	}
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$sessionManager = new SessionManager();

		if ($sessionManager->currentUser() === 'admin') {
			//ajout d'un produit
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

					foreach ($data as $key => $value) {
						switch ($key) {
							case 'nom':
								if (!is_string($value) || strlen($value) > 50) {
									http_response_code(400);
									echo "<result>Erreur : nom doit être une chaîne (max 50)</result>";
									exit;
								}
								break;

							case 'description':
							case 'lien_Image':
								if (!is_string($value) || strlen($value) > 500) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être une chaîne (max 500)</result>";
									exit;
								}
								break;

							case 'prix':
								if (!is_numeric($value) || floatval($value) < 0) {
									http_response_code(400);
									echo "<result>Erreur : prix doit être un nombre décimal positif</result>";
									exit;
								}
								break;

							case 'FK_Categorie':
							case 'FK_Marque':
								if (!ctype_digit($value)) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être un entier</result>";
									exit;
								}
								break;
						}
					}

					// Si toutes les validations passent, on ajoute le produit
					
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
				
			} 
			if (isset($_POST['action']) && $_POST['action'] === 'modify') {
				if (
					isset($_POST['id']) && $_POST['nom'] && isset($_POST['description']) && isset($_POST['lien_Image'])
					&& isset($_POST['prix']) && isset($_POST['FK_Categorie']) && isset($_POST['FK_Marque']))
				 {
					$data = [
						'id'		   => $_POST['id'],
						'nom'          => $_POST['nom'],
						'description'  => $_POST['description'],
						'lien_Image'   => $_POST['lien_Image'],
						'prix'         => $_POST['prix'],
						'FK_Categorie' => $_POST['FK_Categorie'],
						'FK_Marque'    => $_POST['FK_Marque']
					];

					foreach ($data as $key => $value) {
						switch ($key) {
							case 'id':
								if (!is_numeric($value)) {
									http_response_code(400);
									echo "<result>Erreur : id doit etre un nombre</result>";
									exit;
								}
								break;

							case 'nom':
								if (!is_string($value) || strlen($value) > 50) {
									http_response_code(400);
									echo "<result>Erreur : nom doit être une chaîne (max 50)</result>";
									exit;
								}
								break;

							case 'description':
							case 'lien_Image':
								if (!is_string($value) || strlen($value) > 500) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être une chaîne (max 500)</result>";
									exit;
								}
								break;

							case 'prix':
								if (!is_numeric($value) || floatval($value) < 0) {
									http_response_code(400);
									echo "<result>Erreur : prix doit être un nombre décimal positif</result>";
									exit;
								}
								break;

							case 'FK_Categorie':
							case 'FK_Marque':
								if (!ctype_digit($value)) {
									http_response_code(400);
									echo "<result>Erreur : $key doit être un entier</result>";
									exit;
								}
								break;
						}
					}

					// Si toutes les validations passent, on ajoute le produit
					
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
				//supression d'un produit
			} 
			else if (isset($_POST['action']) && $_POST['action'] === 'delete') {
				if(isset($_POST['id'])){
					
					$success = $produitBD->deleteProduct($_POST['id']);
					if ($success) {
						http_response_code(200);
						echo "<result>Produit supprimé avec succès</result>";
						//erreur interne au serveur 
					} else {
						http_response_code(500);
						echo "<result>Erreur lors de la suppression du produit</result>";
					}

				}else {
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
