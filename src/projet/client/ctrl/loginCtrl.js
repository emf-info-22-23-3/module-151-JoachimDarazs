/**
 * Callback exécuté lors d'une connexion réussie.
 * Met à jour le sessionStorage et redirige l'utilisateur.
 * 
 * @param {Object} data - Réponse de la requête contenant les informations de l'utilisateur.
 * @param {string} text - Statut du texte de la réponse.
 * @param {Object} jqXHR - Objet XMLHttpRequest de jQuery.
 */
function connectSuccess(data, text, jqXHR) {
    console.log($(data).find("result").text())
    if (jqXHR.status === 200) {

        
        // Stocker l'état de connexion dans sessionStorage
        sessionStorage.setItem("isConnected", "1");
        if($(data).find("result").text()==='admin'){
            sessionStorage.setItem("isAdmin", "1");
        }
        alert("Vous êtes connectés avec succès !");
        // Rediriger vers la page des produits
        window.location.href = "../ihm/produit.html";
        //charger panier
    }
    

}

/**
 * Callback exécuté en cas d'erreur lors de la connexion.
 * Affiche un message d'alerte correspondant au type d'erreur HTTP reçu.
 * 
 * @param {Object} request - Objet XMLHttpRequest contenant les informations de l'erreur.
 * @param {string} status - Statut de l'erreur.
 * @param {string} error - Message d'erreur détaillé.
 */
function CallbackError(request, status, error) {
    if (request.status === 401) {
        alert("Le mot de passe est incorrect");
    }
    else if (request.status === 404) {
        alert("Cet utilisateur n'existe pas");
    }
    else if (request.status === 400) {
        alert("Merci de remplir tous les champs");
    } else {
        alert("erreur : " + error + ", request: " + request.status + ", status: " + status);
    }
}
    /**
     * Écouteur d'événement sur le bouton de connexion.
     * Empêche le rechargement de la page et envoie les identifiants à la fonction connect.
     */
$(document).ready(function () {



    var butConnect = $("#connect");
    $.getScript("../services/servicesHttp.js", function () {
        console.log("servicesHttp.js chargé !");

    });
    butConnect.click(function (event) {
        event.preventDefault();
        connect(document.getElementById("login").value, document.getElementById("password").value, connectSuccess, CallbackError);
        
    });
});