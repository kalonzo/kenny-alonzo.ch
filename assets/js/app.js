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

//Fonction minimum pour lier un set de table  au plugin DataTable (#table_id = identifiant de la table dans template\candida\index)
$(document).ready( function () {
    $('#table_id').DataTable();
} );

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
