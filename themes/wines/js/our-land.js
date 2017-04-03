$(function (){
	function valign() {
		if ($(window).width() < 1280) 
			$('.col-2').each(function (){
				$(this).height($(this).find('.text').height() + 60);
			})
		else
			$('.col-2').each(function (){
				$(this).height($(this).closest('img').height());
			})
	}

	valign();
	
	$(window).resize(function(){ 
		valign(); 
	});
})
