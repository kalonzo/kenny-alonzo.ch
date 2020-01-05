//import 'startbootstrap-sb-admin-2/dist/css/sb-admin-2.css'; // Importation des css le header
//import 'startbootstrap-sb-admin-2/vendor/bootstrap/css/bootstrap.css'; // Importation des css le header 
$(document).ready(function() {
  $('.header-right li a').click(function(e) {
    alert("ss")

    $('.header-right li.active').removeClass('active');

   var $parent = $(this).parent();
    $parent.addClass('active');
    //e.preventDefault();
  });
});
/*$('.carousel').carousel({
    interval: 1000
  })
*/
