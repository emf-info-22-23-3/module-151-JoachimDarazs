





/**
 * Méthode appelée en cas d'erreur lors de la lecture des produits
 * @param {type} request
 * @param {type} status
 * @param {type} error
 * @returns {undefined}
 */
function chargerPaysError(request, status, error) {
    alert("Erreur lors de la lecture des produits: " + error);
  }


$.getScript("../services/produit.html", function() {
    console.log("servicesHttp.js chargé !");
    chargerTeam(chargerProduitsSuccess, chargerProduitsError);
});