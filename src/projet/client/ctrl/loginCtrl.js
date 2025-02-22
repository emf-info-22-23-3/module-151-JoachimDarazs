function connectSuccess(data, text, jqXHR) {
  
    if ($(data).find("result").text() == 'true')
	{
		alert("Login ok");
		//chargerPersonnel(chargerPersonnelSuccess, CallbackError);
	}
	else{
		alert("Erreur lors du login");
	}

}

function CallbackError(request, status, error) {
    alert("erreur : " + error + ", request: " + request + ", status: " + status);
}

$(document).ready(function() {


    console.log('jean crystoph')
    var butConnect = $("#connect");
    $.getScript("../services/servicesHttp.js", function () {
        console.log("servicesHttp.js chargé !");
        
      });
    butConnect.click(function(event) {
        connect(document.getElementById("login").value, document.getElementById("password").value, connectSuccess, CallbackError);
    });
});