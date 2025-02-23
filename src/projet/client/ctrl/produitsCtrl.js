

/**
 * Méthode appelée lors du retour avec succès du résultat des produits
 * @param {type} data
 * @param {type} text
 * @param {type} jqXHR
 */
function chargerProduitsSuccess(data, text, jqXHR) {
  // Appelé lorsque la liste des produits est reçue
  let contenu = "";
  if(sessionStorage.getItem("isAdmin") === "1"){

  }else{
    

    $(data).find("produit").each(function () {
  
  
      contenu += `<div class="col">`;
      contenu += `<div class="product-card">`;
      contenu += `<div class="card h-100">`;
      contenu += `<div class="image-container">`;
      contenu += `<img src="${$(this).find("lienImage").text()}" class="card-img-top" alt="${$(this).find("description").text()}">`;
      contenu += `</div>`;
      contenu += `<div class="card-body">`;
      contenu += `<h5 class="card-title">${$(this).find("nomP").text()}</h5>`;
      contenu += `<p class="card-text price">${$(this).find("prix").text()} $</p>`;
      contenu += `<button class="btn btn-primary w-100">Ajouter au panier</button>`;
      contenu += `</div>`;
      contenu += `</div>`;
      contenu += `</div>`;
      contenu += `</div>`;
  
    });
    

  }
  
  document.getElementById("grilleProduits").innerHTML = contenu;
  

}

function deconnectSuccess(){
  sessionStorage.removeItem("isConnected");
  let contenu = '<button class="btn btn-outline-primary" id="buttonConnexion"><a href="login.html" class="no-underline"><i class="bi bi-person me-2"></i>Connexion</a></button>';
  $("#buttonDeconnexion").replaceWith(contenu);

}
/**
 * Méthode appelée en cas d'erreur lors de la lecture des produits
 * @param {type} request
 * @param {type} status
 * @param {type} error
 * @returns {undefined}
 */
function chargerProduitsError(request, status, error) {
  alert("Erreur lors de la lecture des produits: " + error);
}
function CallbackError(request, status, error) {

  alert("erreur : " + error + ", request: " + request.status + ", status: " + status);

}

$(document).ready(function () {
  // Charger servicesHttp.js avant de charger les produits
  $.getScript("../services/servicesHttp.js", function () {
    console.log("servicesHttp.js chargé !");


    chargerProduits(chargerProduitsSuccess, chargerProduitsError);
  });

  if (sessionStorage.getItem("isConnected") === "1") {


    $("#buttonConnexion").replaceWith('<button class="btn btn-outline-primary" id="buttonDeconnexion"><i class="bi bi-person me-2"></i>Deconnexion</a></button>');

    $("#buttonDeconnexion").click(function (event) {

      disconnect(deconnectSuccess, CallbackError);

    });
  }



});



