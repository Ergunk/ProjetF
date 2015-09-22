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
    var background = $('<div id="background"></div>'); // Création du fond noir.
    var modalWindow = $('<div id="modalWindow"></div>'); // Création de la fenêtre.
    modalWindow.append('<div class="exit">&#x2715;</div>'); // Ajout du bouton quitter. &#x2715; est une croix.
    modalWindow.append('<img src="etiquette.png">'); // Ajout de l'image dans la fenêtre.
    
    $('body').append(background);  // Ajout du background dans le body.
    $('body').append(modalWindow); // Ajout de la fenêtre dans le body.
    
    $('#background').click(closeModalWindow); // Lorsqu'on clique sur le fond, on appelle la fonction closeModalWindow.
    $('#modalWindow .exit').click(closeModalWindow); // Lorsqu'on clique sur la croix, on appelle la fonction closeModalWindow.
  });
  
});

function closeModalWindow() {
  $('#background').remove(); // On supprime le fond.
  $('#modalWindow').remove(); // On supprime la fenêtre.
}