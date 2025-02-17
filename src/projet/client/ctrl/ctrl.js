

/**
 * Méthode appelée lors du retour avec succès du résultat des produits
 * @param {type} data
 * @param {type} text
 * @param {type} jqXHR
 */
function chargerProduitsSuccess(data, text, jqXHR) {
	// Appelé lorsque la liste des produits est reçue
    
	let contenu = "";
    
    $(data).find("produit").each(function() {
      

      contenu += `<div class="col">`;
      contenu += `<div class="product-card">`;
      contenu += `<div class="card h-100">`;
      contenu += `<img src="${data.find("lien_Image")}" class="card-img-top" alt="${data.find("description")}">`;
      contenu += `<div class="card-body">`;
      contenu += `<h5 class="card-title">${data.find("nomProduit")}</h5>`;
      contenu += `<p class="card-text price">${data.find("prix")}</p>`;
      contenu += `<button class="btn btn-primary w-100">Ajouter au panier</button>`;
      contenu += `</div>`;       
      contenu += `</div>`;               
      contenu += `</div>`;                 
      contenu += `</div>`;                      
       // var  joueur = new Joueur();
       /**  joueur.setNom($(this).find("nom").text());
        joueur.setPoints($(this).find("points").text());
        cmbJoueurs.options[cmbJoueurs.options.length] = new Option(joueur, JSON.stringify(joueur));
*/
        
    });
    document.getElementById("grilleProduits").innerHTML = contenu;
	
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

  $(document).ready(function() {
$.getScript("../services/servicesHttp.js", function() {
    console.log("servicesHttp.js chargé !");
    chargerProduits(chargerProduitsSuccess, chargerProduitsError);
});
});