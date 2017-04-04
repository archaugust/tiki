$(function(){
	var maxHeight = 0;
	$('.box-wine').each(function () {
	    if ( $(this).outerHeight() > maxHeight ) {
	    	maxHeight = $(this).outerHeight(); 
	    }
	});
    $('.box-wine').outerHeight(maxHeight);
});

$('.menu-item').hover(function() {
	var id = $(this).attr('id').split('-');
    $('#wine-'+ id[1]).toggleClass("hover");
})

$('.box-wine').hover(function() {
	var id = $(this).attr('id').split('-');
    $('#link-' + id[1]).toggleClass("hover");
})