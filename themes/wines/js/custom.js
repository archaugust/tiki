$(function(){
	$('.dropdown-container').on('show.bs.dropdown', function() {
	    $(this).find('.dropdown-menu').slideDown();
	    $('.menu-button').css('backgroundImage','url("themes/wines/images/icon-menu-close.png")');
	    console.log($('.menu-button').css('backgroundImage'))
	});
	
	$('.dropdown-container').on('hide.bs.dropdown', function() {
	    $(this).find('.dropdown-menu').slideUp();
	    $('.menu-button').css('backgroundImage','url("themes/wines/images/icon-menu.png")');
	});

	$(window).scroll(function() {
	    if ($(this).scrollTop() >= 50) {
	    	$('#return-to-top').fadeIn(200);
	    } else {
	    	$('#return-to-top').fadeOut(200);
	    }
	});
	
	$('#return-to-top').click(function() {
		$('body,html').animate({
	        scrollTop : 0
	    }, 500);
	});

	$('a[href*=\\#]').on('click', function(event){     
	    event.preventDefault();
	    $('html,body').animate({scrollTop:$(this.hash).offset().top}, 500);
	});
	
	$('#header').affix({
	    offset: {
	        top: 88
	    }
	});

});

$('.menu-body').innerHeight($(document).height());

function validateEmail(emailAddress) {
    var pattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
    return pattern.test(emailAddress);
};


function onSubmit(token) {
	var emptyFields = $('#Form_SubscribeForm input[required]').filter(function() {
	    return $(this).val() === "";
	}).length;

	if (emptyFields == 0) {
		if (validateEmail($('#Form_SubscribeForm_Email').val()))
			$('#Form_SubscribeForm').trigger('submit');
		else
			$('#subscribeDiv').html('Please enter a valid email address.');
	}
	else {
		$('#subscribeDiv').html('Please enter your name and email.');
	}

	grecaptcha.reset(recaptcha1);
}

var recaptcha1;
var onloadCallback = function() {
	
	recaptcha1 = grecaptcha.render('recaptcha1', {
      'sitekey' : '6LczKhsUAAAAAB5v_VO4OpSPeyWfzQ_OzkZSImMQ',
      'callback' : onSubmit
    });
};


$('#Form_SubscribeForm').submit(function(event) {
	var data = $('#Form_SubscribeForm').serialize();
    var recaptcha = grecaptcha.getResponse(recaptcha1);
    $('#subscribeDiv').html('<img src="/themes/wines/images/loading.gif" /> Loading...');
    $.ajax({
        url: "/home/SubscribeForm",
        data: data+"&g-recaptcha-response="+recaptcha,
        type: "POST",
        success: function (data) {
            $('#subscribeDiv').html(data);
            if (data == 'Thanks for subscribing!') 
            	$('#subscribeForm').find('input').attr('disabled','true');
            else
            	grecaptcha.reset(recaptcha1);
        }
    })
    event.preventDefault();
});

