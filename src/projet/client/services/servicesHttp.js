/*
 * Couche de services HTTP (worker).
 *
 */

var BASE_URL = "http://localhost:8080/projet/server/ctrl/";

/**
 * Fonction permettant de demander la liste des produits au serveur.
 * @param {type} Fonction de callback lors du retour avec succès de l'appel.
 * @param {type} Fonction de callback en cas d'erreur.
 */
function chargerProduits(successCallback, errorCallback) {
  $.ajax({
    type: "GET",
    dataType: "xml",
    url: BASE_URL + "produitManager.php",
    xhrFields: {
      withCredentials: true
    },
    success: successCallback,
    error: errorCallback
  });
}

/**
 * Fonction permettant la connexion d'un user
 * @param {type} login, nom d'utilisateur
 * @param {type} passwd, mdp d'un utilisateur
 * @param {type} Fonction de callback lors du retour avec succès de l'appel.
 * @param {type} Fonction de callback en cas d'erreur.
 */
function connect(login, passwd, successCallback, errorCallback) {
  $.ajax({
    type: "POST",
    dataType: "xml",
    url: BASE_URL + "loginManager.php",
    data: 'action=connect&login=' + login + '&password=' + passwd,
    xhrFields: {
      withCredentials: true
    },
    success: successCallback,
    error: errorCallback
  });
}

/**
 * Fonction permettant la deconnexion d'un user
 * @param {type} Fonction de callback lors du retour avec succès de l'appel.
 * @param {type} Fonction de callback en cas d'erreur.
 */
function disconnect(successCallback, errorCallback) {
  $.ajax({
    type: "POST",
    dataType: "xml",
    url: BASE_URL + "loginManager.php",
    data: 'action=disconnect',
    xhrFields: {
      withCredentials: true
    },
    success: successCallback,
    error: errorCallback
  });
}

/**
 * Fonction permettant d'ajouter un produit
 *  @param {type} nom, nom produit
 * @param {type} description, description produit
 * @param {type} lien_Image, lien_Image produit
 * @param {type} prix, prix produit
 * @param {type} FK_Categorie, categorie produit
 * @param {type} FK_Marque, marque produit
 * @param {type} Fonction de callback lors du retour avec succès de l'appel.
 * @param {type} Fonction de callback en cas d'erreur.
 */
function addProduit(nom, description, lien_Image, prix, FK_Categorie, FK_Marque, successCallback, errorCallback) {
  $.ajax({
    type: "POST",
    dataType: "xml",
    url: BASE_URL + "produitManager.php",
    data: 'action=add&nom=' + nom + '&description=' + description + '&lien_Image=' + lien_Image + '&prix=' + prix + '&FK_Categorie=' + FK_Categorie + '&FK_Marque=' + FK_Marque,
    xhrFields: {
      withCredentials: true
    },
    success: successCallback,
    error: errorCallback
  });
}

/**
 * Fonction permettant de modifier un produit
 * @param {type} id, nom produit
 * @param {type} nom, nom produit
 * @param {type} description, description produit
 * @param {type} lien_Image, lien_Image produit
 * @param {type} prix, prix produit
 * @param {type} FK_Categorie, categorie produit
 * @param {type} FK_Marque, marque produit
 * @param {type} Fonction de callback lors du retour avec succès de l'appel.
 * @param {type} Fonction de callback en cas d'erreur.
 */
function addProduit(id, nom, description, lien_Image, prix, FK_Categorie, FK_Marque, successCallback, errorCallback) {
  $.ajax({
    type: "POST",
    dataType: "xml",
    url: BASE_URL + "produitManager.php",
    data: 'action=add&id='+id+'&nom=' + nom + '&description=' + description + '&lien_Image=' + lien_Image + '&prix=' + prix + '&FK_Categorie=' + FK_Categorie + '&FK_Marque=' + FK_Marque,
    xhrFields: {
      withCredentials: true
    },
    success: successCallback,
    error: errorCallback
  });
}

/**
 * Fonction permettant de supprimer un produit
 *  @param {type} id, nom produit
 * 
 */
function deleteProduit(id, successCallback, errorCallback) {
  $.ajax({
    type: "POST",
    dataType: "xml",
    url: BASE_URL + "produitManager.php",
    data: 'action=delete&id=' + id,
    xhrFields: {
      withCredentials: true
    },
    success: successCallback,
    error: errorCallback
  });
}





