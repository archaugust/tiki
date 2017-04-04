$(function (){
	$(window).resize(function(){ 
		if ($(window).width() < 1280) 
			$('.col-2').each(function (){
				$(this).height($(this).find('.text').height() + 140);
			})
		else
			$('.col-2').each(function (){
				$(this).height($('.col-photo').height());
				console.log($('.col-photo').height());
			});
	});
	
	$(window).trigger('resize');
})
