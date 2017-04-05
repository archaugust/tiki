	$(window).resize(function(){
		var maxHeight = -1;
		$('.description div').each(function () {
		    if ( $(this).height() > maxHeight ) {
		    	maxHeight = $(this).height(); 
		    }
		});
	    $('.description').height(maxHeight);
	    console.log(maxHeight);
	});
