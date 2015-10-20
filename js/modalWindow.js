/*
a) JavaScript autorise les fonctions annonymes.

Exemple :
unBouton.onclick = function() {
  alert('Vous avez cliqué');
}

b) La fonction "$" de jQuery lance une fonction lorsque le DOM est prêt.

c) Au vu de a) et b), $(function(){...}); lance une fonction annonyme quand le DOM est prêt.
*/

$(function() {
  /*
    jQuery permet d'identifier des éléments du DOM comme le ferait le CSS.
    
    $('#run') est l'élément d'ID "run".
    $('div') serait la liste de tous les div.
    $('.highlight') serait la liste de tous les éléments possédant la classe "highlight".
  */
  $('#run').click(function() {

	
	$('#modalWindow').show();
	$('#background').show();
    
    $('#background').click(closeModalWindow); // Lorsqu'on clique sur le fond, on appelle la fonction closeModalWindow.
    $('#modalWindow .exit').click(closeModalWindow); // Lorsqu'on clique sur la croix, on appelle la fonction closeModalWindow.
  });
  
});

function closeModalWindow() {
  
  $('#background').hide(); // On supprime le fond.
  $('#modalWindow').hide(); // On supprime la fenêtre.
}