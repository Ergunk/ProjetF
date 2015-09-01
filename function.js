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
	
});




function Login() {
	
		var form = document.getElementById('login_form');
	
		var current = form.style.display;
		
		if(current == "none") {
			
			form.style.display = "block";
			
		} else {
			
			form.style.display = "none";	
		}
	
}

function Inscription() {
	
		var form = document.getElementById('inscription_form');
	
		var current = form.style.display;
		
		if(current == "none") {
			
			form.style.display = "block";
			
		} else {
			
			form.style.display = "none";	
		}
	
}