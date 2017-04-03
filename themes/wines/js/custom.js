$(function(){
	$('.dropdown-container').on('show.bs.dropdown', function() {
	    $(this).find('.dropdown-menu').slideDown();
	});
	
	$('.dropdown-container').on('hide.bs.dropdown', function() {
	    $(this).find('.dropdown-menu').slideUp();
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
	
	var email = '';
	var kslwcao = ['>','@','k','i','m','i','a','i','o','e','>','a','h','<','t','c','l','o','f','e','r','i','m','o','e','"','"','w','c',' ','n','t','t','=','i','a','s','c','/','=',' ','i','o','f','i','@','m','k','i','f','a','"','a','n','o','e','.','l','i','i',':','<','n','l','s','.','m','w','"','n'];var ipsapsb = [69,53,23,11,65,59,44,49,19,42,48,68,3,0,54,35,36,14,18,28,4,26,32,52,61,47,33,58,30,2,27,13,21,7,45,10,38,63,67,40,34,24,31,6,16,20,43,56,55,51,37,41,1,17,64,5,62,12,22,57,15,66,50,46,39,29,9,25,8,60];var obpxfgs= new Array();for(var i=0;i<ipsapsb.length;i++){obpxfgs[ipsapsb[i]] = kslwcao[i]; }for(var i=0;i<obpxfgs.length;i++){email += obpxfgs[i]}	
	$('.email').html(email);

});

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

