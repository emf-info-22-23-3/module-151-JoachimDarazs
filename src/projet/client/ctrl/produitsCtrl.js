/**
 * Méthode appelée lors du retour avec succès du résultat des produits.
 * Génère dynamiquement le contenu HTML en fonction des produits reçus.
 * 
 * @param {XMLDocument} data - Données XML des produits reçus.
 * @param {string} text - Statut du retour de la requête.
 * @param {jqXHR} jqXHR - Objet XMLHttpRequest utilisé pour la requête AJAX.
 */
function chargerProduitsSuccess(data, text, jqXHR) {
  // Appelé lorsque la liste des produits est reçue
  let contenu = "";
  if (sessionStorage.getItem("isAdmin") === "1") {
    $(data)
      .find("produit")
      .each(function () {
        contenu += `<div class="col" id="produit-${$(this).find("idP").text()}">`;
        contenu += `<div class="product-card">`;
        contenu += `<div class="card h-100">`;
        contenu += `<div class="card-body">`;
        contenu += `<label for="inputId"><strong>Nom :</strong></label>`;
        contenu += `<input type="text" id="textInput" value ="${$(this)
          .find("nomP")
          .text()}" placeholder="nom du produit" disabled>`;
        contenu += `<label for="inputId"><strong>Description :</strong></label>`;
        contenu += `<input type="text" id="textInput" value ="${$(this)
          .find("description")
          .text()}" placeholder="description du produit" disabled>`;
        contenu += `<label for="inputId"><strong>Lien image :</strong></label>`;
        contenu += `<input type="text" id="textInput" value ="${$(this)
          .find("lienImage")
          .text()}" placeholder="lien de l'image du produit" disabled>`;
        contenu += `<label for="inputId"><strong>Prix :</strong></label>`;
        contenu += `<input type="text" id="number" value ="${$(this)
          .find("prix")
          .text()}" placeholder="prix du produit" disabled>`;
        contenu += `<label for="inputId"><strong>Id categorie :</strong></label>`;
        contenu += `<input type="text" id="number" value ="${$(this)
          .find("categorie")
          .find("id")
          .text()}" placeholder="id de la categorie" disabled>`;
        contenu += `<label for="inputId"><strong>Id marque :</strong></label>`;
        contenu += `<input type="text" id="number" value ="${$(this)
          .find("marque")
          .find("id")
          .text()}" placeholder="id de la marque" disabled>`;
        contenu += `</div>`;
        contenu += `<div class="card-body">`;
        contenu += `<button class="btn btn-primary btn-save w-100" disabled>save</button>`;
        contenu += `</div>`;
        contenu += `<div class="card-body">`;
        contenu += `<button class="btn btn-primary btn-modify w-100" >modify</button>`;
        contenu += `</div>`;
        contenu += `<div class="card-body">`;
        contenu += `<button class="btn btn-primary btn-delete w-100" disabled>delete</button>`;
        contenu += `</div>`;
        contenu += `</div>`;
        contenu += `</div>`;
        contenu += `</div>`;
      });
    document.getElementById(
      "btnAjoutPlace"
    ).innerHTML = `<button id="btnAjouter">Ajouter</button>`;
  } else {
    $(data)
      .find("produit")
      .each(function () {
        contenu += `<div class="col">`;
        contenu += `<div class="product-card">`;
        contenu += `<div class="card h-100">`;
        contenu += `<div class="image-container">`;
        contenu += `<img src="${$(this)
          .find("lienImage")
          .text()}" class="card-img-top" alt="${$(this)
          .find("description")
          .text()}">`;
        contenu += `</div>`;
        contenu += `<div class="card-body">`;
        contenu += `<h5 class="card-title">${$(this).find("nomP").text()}</h5>`;
        contenu += `<p class="card-text price">${$(this)
          .find("prix")
          .text()} $</p>`;
        contenu += `<button class="btn btn-primary w-100">Ajouter au panier</button>`;
        contenu += `</div>`;
        contenu += `</div>`;
        contenu += `</div>`;
        contenu += `</div>`;
      });
  }

  document.getElementById("grilleProduits").innerHTML = contenu;
}

/**
 * Méthode appelée en cas de déconnexion réussie de l'utilisateur.
 * Supprime les informations de session et met à jour l'interface utilisateur.
 */
function deconnectSuccess() {
  sessionStorage.removeItem("isConnected");
  if (sessionStorage.getItem("isAdmin")) {
    sessionStorage.removeItem("isAdmin");
  }
  let contenu =
    '<button class="btn btn-outline-primary" id="buttonConnexion"><a href="login.html" class="no-underline"><i class="bi bi-person me-2"></i>Connexion</a></button>';
  $("#buttonDeconnexion").replaceWith(contenu);
  location.reload();
}
/**
 * Méthode appelée en cas d'erreur lors de la récupération des produits.
 * Affiche une alerte avec le message d'erreur.
 * 
 * @param {XMLHttpRequest} request - Objet contenant la requête HTTP.
 * @param {string} status - Statut de l'erreur.
 * @param {string} error - Message d'erreur retourné.
 */
function chargerProduitsError(request, status, error) {
  alert("Erreur lors de la lecture des produits: " + error);
}
/**
 * Méthode appelée en cas d'erreur générique.
 * Affiche une alerte contenant les détails de l'erreur.
 * 
 * @param {XMLHttpRequest} request - Objet contenant la requête HTTP.
 * @param {string} status - Statut de l'erreur.
 * @param {string} error - Message d'erreur retourné.
 */
function CallbackError(request, status, error) {
  alert(
    "erreur : " + error + ", request: " + request.status + ", status: " + status
  );
}
/**
 * Ajoute un formulaire vide pour l'ajout d'un nouveau produit par un administrateur.
 * Insère dynamiquement un nouveau bloc de produit dans l'interface.
 */
function ajoutProduitAdminVide() {
  let contenu = ``;
  contenu += `<div class="col new-product">`;
  contenu += `<div class="product-card">`;
  contenu += `<div class="card h-100">`;
  contenu += `<div class="card-body">`;
  contenu += `<label for="inputId"><strong>Nom :</strong></label>`;
  contenu += `<input type="text" id="textInput"  placeholder="nom du produit" disabled>`;
  contenu += `<label for="inputId"><strong>Description :</strong></label>`;
  contenu += `<input type="text" id="textInput"  placeholder="description du produit" disabled>`;
  contenu += `<label for="inputId"><strong>Lien image :</strong></label>`;
  contenu += `<input type="text" id="textInput"  placeholder="lien de l'image du produit" disabled>`;
  contenu += `<label for="inputId"><strong>Prix :</strong></label>`;
  contenu += `<input type="text" id="number"  placeholder="prix du produit" disabled>`;
  contenu += `<label for="inputId"><strong>Id categorie (1-10):</strong></label>`;
  contenu += `<input type="text" id="number"  placeholder="id de la categorie" disabled>`;
  contenu += `<label for="inputId"><strong>Id marque (1-10):</strong></label>`;
  contenu += `<input type="text" id="number"  placeholder="id de la marque" disabled>`;
  contenu += `</div>`;
  contenu += `<div class="card-body">`;
  contenu += `<button class="btn btn-primary btn-add w-100" disabled>add</button>`;
  contenu += `</div>`;
  contenu += `<div class="card-body">`;
  contenu += `<button class="btn btn-primary btn-modify w-100" >modify</button>`;
  contenu += `</div>`;
  contenu += `</div>`;
  contenu += `</div>`;
  contenu += `</div>`;

  document.getElementById("grilleProduits").innerHTML += contenu;
}

$(document).ready(function () {
  /**
   * Charge le script servicesHttp.js avant de récupérer les produits.
   * Vérifie aussi si l'utilisateur est connecté pour ajuster l'affichage.
   */
  $.getScript("../services/servicesHttp.js", function () {
    console.log("servicesHttp.js chargé !");

    chargerProduits(chargerProduitsSuccess, chargerProduitsError);
  });

  if (sessionStorage.getItem("isConnected") === "1") {
    $("#buttonConnexion").replaceWith(
      '<button class="btn btn-outline-primary" id="buttonDeconnexion"><i class="bi bi-person me-2"></i>Deconnexion</a></button>'
    );

    $("#buttonDeconnexion").click(function (event) {
      disconnect(deconnectSuccess, CallbackError);
    });
  }
  /**
   * Ajoute un nouveau produit lorsqu'on clique sur le bouton "Ajouter".
   * Vérifie d'abord si un formulaire dynamique est déjà présent.
   */
  $(document).on("click", "#btnAjouter", function () {
    if ($(".product-card[data-source='dynamic']").length === 0) {
      ajoutProduitAdminVide();
      $(this).prop("disabled", true);
    }
  });
  /**
   * Active l'édition des champs d'un produit lorsqu'on clique sur "Modify".
   * Dégrise les inputs et active les boutons "Save" et "Delete".
   */
  $(document).on("click", ".btn-modify", function () {
    let card = $(this).closest(".card"); // Récupère la carte du produit
    card.find("input").prop("disabled", false); // Dégrise tous les inputs
    card.find(".btn-save, .btn-delete, .btn-add").prop("disabled", false); // Active "Save" et "Delete"
    $(this).prop("disabled", true); // Grise "Modify"
  });
 /**
   * Sauvegarde les modifications d'un produit.
   * Vérifie que tous les champs sont remplis avant d'envoyer la requête.
   * 
   * Désactive les boutons et recharge la page après modification réussie.
   */
  $(document).on("click", ".btn-save", function () {
    let card = $(this).closest(".card"); // Récupère la carte du produit
    let allInputs = card.find("input"); // Sélectionne tous les inputs
    let productId = card.closest(".col").attr("id").replace("produit-", ""); // Récupère l'ID du produit
  
    // Vérifier si un champ est vide
    let allFilled = true;
    allInputs.each(function () {
      if ($(this).val().trim() === "") {
        allFilled = false;
        $(this).addClass("border border-danger"); // Ajoute un style rouge
      } else {
        $(this).removeClass("border border-danger"); // Enlève le style rouge si rempli
      }
    });
  
    if (!allFilled) {
      alert("Veuillez remplir tous les champs avant d'enregistrer !");
      return; // Arrête la fonction ici si un champ est vide
    }
  
    // Récupération des valeurs des inputs
    let nom = card.find('input[placeholder="nom du produit"]').val().trim();
    let description = card.find('input[placeholder="description du produit"]').val().trim();
    let lien_Image = card.find('input[placeholder="lien de l\'image du produit"]').val().trim();
    let prix = card.find('input[placeholder="prix du produit"]').val().trim();
    let FK_Categorie = card.find('input[placeholder="id de la categorie"]').val().trim();
    let FK_Marque = card.find('input[placeholder="id de la marque"]').val().trim();
  
    // Appel de la méthode modifyProduit
    modifyProduit(
      productId,
      nom,
      description,
      lien_Image,
      prix,
      FK_Categorie,
      FK_Marque,
      function () {
        alert("Produit modifié avec succès !");
        allInputs.prop("disabled", true);
        card.find(".btn-modify").prop("disabled", false);
        $(this).prop("disabled", true);
        card.find(".btn-delete").prop("disabled", true);
        location.reload();

      },
      CallbackError
    );
  });
  /**
   * Ajoute un nouveau produit avec les informations saisies.
   * Vérifie que tous les champs sont remplis avant l'ajout.
   */
  $(document).on("click", ".btn-add", function () {
    let card = $(this).closest(".card"); // Récupère la carte du produit
    let allInputs = card.find("input"); // Sélectionne tous les inputs

    // Vérifier si un champ est vide
    let allFilled = true;
    allInputs.each(function () {
      if ($(this).val().trim() === "") {
        allFilled = false;
        $(this).addClass("border border-danger"); // Ajoute un style rouge
      } else {
        $(this).removeClass("border border-danger"); // Enlève le style rouge si rempli
      }
    });

    if (!allFilled) {
      alert("Veuillez remplir tous les champs avant d'enregistrer !");
      return; // Arrête la fonction ici si un champ est vide
    } else {
      // Récupération des valeurs des inputs
      let nom = card.find('input[placeholder="nom du produit"]').val().trim();
      let description = card.find('input[placeholder="description du produit"]').val().trim();
      let lien_Image = card.find('input[placeholder="lien de l\'image du produit"]').val().trim();
      let prix = card.find('input[placeholder="prix du produit"]').val().trim();
      let FK_Categorie = card.find('input[placeholder="id de la categorie"]').val().trim();
      let FK_Marque = card.find('input[placeholder="id de la marque"]').val().trim();

      // Appel de la méthode addProduit avec les valeurs récupérées
      addProduit(
        nom,
        description,
        lien_Image,
        prix,
        FK_Categorie,
        FK_Marque,
        function () {
          alert("Produit ajouté avec succès !");
          allInputs.prop("disabled", true);
          $(this).prop("disabled", true);
          card.find(".btn-modify").prop("disabled", false);
          location.reload();
        },
        CallbackError
      );
    }
  });

 /**
   * Supprime un produit après confirmation de l'utilisateur.
   * Envoie une requête de suppression et retire le produit de l'affichage.
   */
  $(document).on("click", ".btn-delete", function () {
    let container = $(this).closest(".col"); // Récupère le conteneur du produit
    let containerId = container.attr("id"); // Ex: "produit-12"
    
    if (containerId) {
      let productId = containerId.replace("produit-", ""); // Extrait seulement l'ID numérique
  
      if (confirm("Voulez-vous vraiment supprimer ce produit ?")) {
        deleteProduit(
          productId,
          function () {
            alert("Produit supprimé avec succès !");
            container.remove(); // Supprime le produit de l'affichage
          },
          CallbackError
        );
      }
    }
  });
});
