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