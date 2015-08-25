$(function(){
	
    $('.month').hide();
    $('.month:first').show();
    $('.months a:first').addClass('active');
       
	var current = 1;  
		
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
		
		
		
		$(this).addClass('active');
		$(this).find('.daytitle').css('display', 'block');
		$(this).find('.events').css('display', 'block');
		
	
		$(this).find('ul').addClass('active');
		
		
	});
});
