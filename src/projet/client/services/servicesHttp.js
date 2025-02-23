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
    success: successCallback,
    error: errorCallback
  });
}

/**
 * Fonction permettant la connexion d'un user
 * @param {type} passwd, mdp d'un utilisateur
 * 
 * @param {type} Fonction de callback lors du retour avec succès de l'appel.
 * @param {type} Fonction de callback en cas d'erreur.
 */
function connect(login, passwd, successCallback, errorCallback) {
  $.ajax({
      type: "POST",
      dataType: "xml",
      url: BASE_URL + "loginManager.php",
      data: 'action=connect&login='+ login +'&password=' + passwd,
      success: successCallback,
      error: errorCallback
  });
}
