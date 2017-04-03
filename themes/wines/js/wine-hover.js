$('.menu-link').hover(function() {
	var id = $(this).attr('id').split('-');
    $('#wine-'+ id[1]).toggleClass("hover");
})

$('.box-wine').hover(function() {
	var id = $(this).attr('id').split('-');
    $('#link-' + id[1]).toggleClass("hover");
})