function connectSuccess(data, text, jqXHR) {
    console.log($(data).find("result").text())
    if (jqXHR.status === 200)
	{

        alert("Vous êtes connectés avec succès !");
		
		//chargerPersonnel(chargerPersonnelSuccess, CallbackError);
	}
    else if(jqXHR.status === 401)
    {
        alert("Le mot de passe est incorrecte");
    }
	else if(jqXHR.status === 400)
    {
        
        alert("Merci de remplir tous les champs");
		
	}
    
    else if(jqXHR.status === 404)
    {
        alert("Cette utilisateur n'existe pas");
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
    }else{
    alert("erreur : " + error + ", request: " + request.status + ", status: " + status);
    }
}

$(document).ready(function() {


    
    var butConnect = $("#connect");
    $.getScript("../services/servicesHttp.js", function () {
        console.log("servicesHttp.js chargé !");
        
      });
    butConnect.click(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page
        connect(document.getElementById("login").value, document.getElementById("password").value, connectSuccess, CallbackError);
        console.log(document.getElementById("login").value)
    });
});