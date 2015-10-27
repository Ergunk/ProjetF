/* Fonction qui permet de supprimer un événement */ 
function DeleteEvent(idEvent , pseudo) {
		$.ajax({
			type: 'POST', // la requête est de type POST
			url: "function.php", // on donne l'URL du fichier de traitement
			data: { action: "DeleteEvent" , id: idEvent , user : pseudo }, // On envoie l'action DeleteEvent 
			success : function(data) {
				
				location.reload(); // on recharge la page
			}
		});
		
		
				
}

/* Fonction qui met à jour les messages du chat */
function updateChat() {
		
		$.ajax({
			type: 'GET',
			url: "getmessage.php",
			success : function(data) {
				
				/* Met les messages dans le block */
				document.getElementById("message_area").innerHTML = data;
				
			}
		});
}

/* Fonction qui met à jour les utilisateurs connectés (chat) */
function updateUsers() {
	
	$.ajax({
			type: 'GET',
			url: "getusers.php",
			success : function(data) {
				
				document.getElementById("users-online").innerHTML = data;
				
			}
	});
}


/* Fonction qui ajoute un participant à un événement */

function AddParticipant(idEvent , idUser) {
		
		$.ajax({
			type: 'POST',
			url: "function.php",
			data: { action: "AddParticipant" , id: idEvent , user : idUser },
			success : function(data) {
				
				location.reload();
			}
		});
}

/* Permet d'afficher le formulaire d'inscription */ 
function Inscription() {
		document.getElementById('login_form').style.display = "none";		
		var form = document.getElementById('inscription_form');
		var current = form.style.display;
		if(current == "none") {
			form.style.display = "block";		
		} else {			
			form.style.display = "none";	
		}
}

/* Permet d'afficher le formulaire de connexion */ 
function Login() {
		document.getElementById('inscription_form').style.display = "none";	
		var form = document.getElementById('login_form');
		var current = form.style.display;	
		if(current == "none") {		
			form.style.display = "block";		
		} else {		
			form.style.display = "none";	
		}
}


$(function(){
	
	
	var d = new Date();

	var currentMonth = d.getMonth();
	
	/* Cache tous les mois */
    $('.month').hide();
	/* Affiche le mois actuelle */
    $('.month').eq(currentMonth).show();
    $('.months a').eq(currentMonth).addClass('active');
      
	/* on ajoute 1 car le compteur par de 0 */
	var current = currentMonth+1;  
		
	/* Evenement lancé quand l'utilisateur clique sur un mois */	
    $('.months a').click(function(){
		
		/* Récupère le numéro du mois en enlevant linkMonth de l'id */
        var month = $(this).attr('id').replace('linkMonth','');
		
		/* Regarde si le mois récupèré est différent du mois actuelle */
        if(month != current){
			
			/*  Cache le mois actuelle et affiche celui cliquer par l'utilisateur */
            $('#month'+current).slideUp();
			$('#month'+month).slideDown();
            
            $('.months a').removeClass('active'); 
            $('.months a#linkMonth'+month).addClass('active'); 
            current = month;
        }
        return false; 
    });
	
	
	/* Permet d'afficher le formulaire quand on clique sur une case du calendrier */
	$('.block').click(function() {
	
		/* Cache les blocks */
		$('.block.active').removeClass('active');
		$('.daytitle').css('display', 'none');
		$('.events').removeClass('active');
		$('.addevent').removeClass('active');	
		$('.addevent').css('display', 'none');

		/* Affiche celui qui a declenché l'événement */
		$(this).addClass('active');
		$(this).find('.daytitle').css('display', 'block');
		$(this).find('.events').css('display', 'block');
		$(this).find('.addevent').addClass('active');
		
	
		$(this).find('ul').addClass('active');
		
		
	});

	/* Permet d'afficher la description quand on clique sur un événement */
	$('.event').click(function() {
			
		$(this).find('.description').toggleClass('active');

	});
	
	
	
	/* Envoie des données du chat */
	$('#submit_chat').click(function() {
		
		var iduser = encodeURIComponent( $('#iduser').val() ); 
		var pseudo = encodeURIComponent( $('#pseudo').val() ); 
		var message = encodeURIComponent( $('#message').val() );
		$('#message').val('');

		if(pseudo != "" && message != ""){ // on vérifie que les variables ne sont pas vides
			$.ajax({

				url : "chat.php", // on donne l'URL du fichier de traitement
				type : "POST", // la requête est de type POST
				data : "iduser=" + iduser + "&pseudo=" + pseudo + "&message=" + message, // et on envoie nos données
				success : function(data) {	
					
					updateChat();
					
				}
			});
		}
		
	});

	
	/* Permet d'envoyer le message même en cliquant sur Enter (plus besoin de passer par le bouton) */
	$('#message').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#submit_chat').click();
		}
	});


});




