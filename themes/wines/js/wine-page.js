$('.box-label').click(function (){
	var id = $(this).attr('id').split('-');

	var bottom = $(this).position().top + $(this).outerHeight(true) + 40;
	$('#brand-details').css('top', bottom);
	$('#brand-details').show();
	$('#brand-details .row').hide();
	$('.box-labels .arrow').hide();
	$(this).find('.arrow').show();
    $('#details-'+ id[1]).slideDown();
    $('html, body').animate({
        scrollTop: $('#brand-details').offset().top - 200
    }, 300);
})

$('#close').click(function(){
	$('.box-labels .arrow').hide();
	$('#brand-details').fadeOut();
})