function Login() {
		
		document.getElementById('menu').classList.remove("active");
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
		
		document.getElementById('menu').classList.remove("active");
		
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
				
				window.location.href = window.location.href;
			}
		});
}


function AddParticipant(idEvent , idUser) {
		
		$.ajax({
			type: 'POST',
			url: "function.php",
			data: { action: "AddParticipant" , id: idEvent , user : idUser },
			success : function(data) {
				
				window.location.href = window.location.href;
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
		
		var menu = $('#menu');
		menu.toggleClass('active');
		
		var formLog = $('#login_form');
		var formInc = $('#inscription_form');
		
		formLog.css('display', 'none');
		formInc.css('display', 'none');
	});
	
	
	



		


});




