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

function DeleteEvent(idEvent , pseudo) {
		$.ajax({
			type: 'POST',
			url: "function.php",
			data: { action: "DeleteEvent" , id: idEvent , user : pseudo },
			success : function(data) {
				
				location.reload();
			}
		});
}

function updateChat() {
		
		$.ajax({
			type: 'GET',
			url: "getmessage.php",
			success : function(data) {
				
				document.getElementById("message_area").innerHTML = data;
				
			}
		});
}

function updateUsers() {
	
	$.ajax({
			type: 'GET',
			url: "getusers.php",
			success : function(data) {
				
				document.getElementById("users-online").innerHTML = data;
				
			}
	});
}



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




$(function(){
	
	
	var d = new Date();

	var currentMonth = d.getMonth();
	
	
    $('.month').hide();
    $('.month').eq(currentMonth).show();
    $('.months a').eq(currentMonth).addClass('active');
       
	var current = currentMonth+1;  
		
    $('.months a').click(function(){
        var month = $(this).attr('id').replace('linkMonth','');
		

		
        if(month != current){
            $('#month'+current).slideUp();
			$('#month'+month).slideDown();
		
			
            
            $('.months a').removeClass('active'); 
            $('.months a#linkMonth'+month).addClass('active'); 
            current = month;
        }
        return false; 
    });
	
	$('.block').click(function() {
		
		
		
		$('.block.active').removeClass('active');
		$('.daytitle').css('display', 'none');
		$('.events').removeClass('active');
		$('.addevent').removeClass('active');	
		$('.addevent').css('display', 'none');
		
		
		
		$(this).addClass('active');
		$(this).find('.daytitle').css('display', 'block');
		$(this).find('.events').css('display', 'block');
		$(this).find('.addevent').addClass('active');
		
	
		$(this).find('ul').addClass('active');
		
		
	});

	
	$('.event').click(function() {
		
	
		
		$(this).find('.description').toggleClass('active');
		
	
			
	});
	
	
	
	$('#toggle').click(function() {
		
		var toggle = $('#toggle');
		toggle.toggleClass('disable');
		
		var menu = $('#menu');
		menu.toggleClass('active');
		
		var formLog = $('#login_form');
		var formInc = $('#inscription_form');
		
		formLog.css('display', 'none');
		formInc.css('display', 'none');
	});
	
	
	
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
					//$('#message_area').append("<p>" + pseudo + " dit : " + message + "</p>"); // on ajoute 
				}
			});
		}
		
	});


	$('#message').keydown(function(e) {
		if (e.keyCode == 13) {
			$('#submit_chat').click();
		}
	});


});




