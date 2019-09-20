/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import 'datatables.net-dt/css/jquery.datatables.css'; // Importation des css pour le plugin DataTable
import 'jquery';
import 'moment/moment.js';



// require jQuery normally
const $ = require('jquery');

// crée la variable globa $ et les variables Jquery
global.$ = global.jQuery = $;

require('bootstrap');
require ('moment/moment.js');
require('@fortawesome/fontawesome-free/js/all.js');
require( 'datatables.net-dt');//inclusion du plugin  Jquery DataTable

// création du cookie d'avertissement
function createCookie(name, value, days) {
    if(days){
		var date = new Date();
		date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
		var expires = "; expires=" + date.toGMTString();
	}
	else var expires = "";
	document.cookie  = name + "=" + value + expires + "; path=/";
}
// lecture du cookie
function readCookie(name) {
	var nameEQ = name + "=";
	var ca     = document.cookie.split(';');
	for(var i = 0; i < ca.length; i ++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return null;
}

//Wrapper Cookies
$(document).ready(function(){
    // Notifications pour les cookies
    var cookie_avert   = readCookie("cookie_avert"),
        g_analytics_id = "xxxxxx-x", // Id unique google analytics 
        domain_name    = "192.168.1.134"; // nom de domaine du site

    if(cookie_avert === null) { // si le cookie n'existe pas
        //alert("test");
        var banner_text = 'En poursuivant votre navigation sur ce site, vous acceptez l’utilisation de cookies à des fins de mesure d\'audience. <button class="btn btn-success btn-gradient btn-sm" id="accept-cookie">J\'accepte</button> <button class="btn btn-danger btn-gradient btn-sm" id="deny-cookie">Je refuse</button>';
        $("body").prepend('<div id="cookies-banner" class="alert alert-warning text-center">' + banner_text + '</div>');
        $("body").css({"top" : $("#cookies-banner").outerHeight() + "px", "position" : "relative"});
        
        // si on accepte, le cookie avec la valeur 'set' est créée, sinon, la valeur 'not'
        $("#accept-cookie, #deny-cookie").click(function(){
            var id_button     = $(this).attr("id");
            var action_button = (id_button == "accept-cookie")? 'set' : 'not';
        
            createCookie("cookie_avert", action_button, 30);//jour
    	    $("#cookies-banner").slideUp(350).remove();
		    $("body").css({"top" : "0", "position" : ""});
        
            if(action_button == "set"){ // le cookie avec la valeur 'set' est créée (accept)
                /*/ on charge Google analytics
                $.ga.load(g_analytics_id, function(pageTracker) {
    	    		pageTracker._setDomainName(host);
				});*/
            }
        });
    
        // si aucune action au bout de 10 secondes (implicite)
        setTimeout(function(){
            $("#cookies-banner").slideUp(1200).remove();
            $("body").css({"top" : "0", "position" : ""});
            
            /*/ on charge Google analytics
            $.ga.load(g_analytics_id, function(pageTracker) {
    	    	pageTracker._setDomainName(host);
			});*/
        }, 10000); // 10 sec
        
    }else if(cookie_avert == "set"){ // si le cookie existe avec la valeur 'set'
        /*/ on charge google analytics
        $.ga.load(g_analytics_id, function(pageTracker) {
    	    pageTracker._setDomainName(host);
		});*/
    }
});

//Fonction minimum pour lier un set de table  au plugin DataTable (#table_id = identifiant de la table dans template\candida\index)
$(document).ready( function () {
    $('#table_id').DataTable();
} );

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
