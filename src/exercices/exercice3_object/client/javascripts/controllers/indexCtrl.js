/*
 * Contrôleur de la vue "index.html"
 *
 * @author Olivier Neuhaus
 * @version 1.0 / 20-SEP-2013
 */

/**
 * Méthode appelée lors du retour avec succès du résultat
 * @param {type} data
 * @param {type} text
 * @param {type} jqXHR
 */
function chargerTeamSuccess(data, text, jqXHR) {
    // appelé lorsque l'on reçoit les données de la part du PHP
	//

    $.each(data, function(index, team) {
        var row = '<tr><td>' + team.id + '</td><td>' + team.name + '</td></tr>';
        $("#tableContent").append(row);
        console.log("chargerSucces");
    });
}

/**
 * Méthode appelée en cas d'erreur lors de la lecture du webservice
 * @param {type} data
 * @param {type} text
 * @param {type} jqXHR
 */
    function chargerTeamError(request, status, error) {
        // appelé s'il y a une erreur lors du retour
        alert("erreur : " + error + ", request: " + request + ", status: " + status);
    }

/**
 * Méthode "start" appelée après le chargement complet de la page
 */
    $(document).ready(function() {
        $.getScript("javascripts/services/servicesHttp.js", function() {
            console.log("servicesHttp.js chargé !");
            chargerTeam(chargerTeamSuccess, chargerTeamError);
        });

        
    });

