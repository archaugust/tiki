var recaptcha2;
var onloadCallback = function() {
	
	recaptcha1 = grecaptcha.render('recaptcha1', {
      'sitekey' : '6LczKhsUAAAAAB5v_VO4OpSPeyWfzQ_OzkZSImMQ',
      'callback' : onSubmit
    });

	recaptcha2 = grecaptcha.render('recaptcha2', {
	    'sitekey' : '6LczKhsUAAAAAB5v_VO4OpSPeyWfzQ_OzkZSImMQ',
	    'callback' : onContactSubmit
	  });
};

function onContactSubmit(token) {
	var emptyFields = $('#Form_ContactForm input[required], #Form_ContactForm textarea[required]').filter(function() {
	    return $(this).val() === "";
	}).length;

	if (emptyFields == 0) {
		if (validateEmail($('#Form_ContactForm_Email').val()))
			$('#Form_ContactForm').trigger('submit');
		else
			$('#contactDiv').html('Please enter a valid email address.');
	}
	else {
		$('#contactDiv').html('Please specify all required fields.');
	}

	grecaptcha.reset(recaptcha2);
}

$('#Form_ContactForm').submit(function(event) {
	var data = $('#Form_ContactForm').serialize();
    var recaptcha = grecaptcha.getResponse(recaptcha2);
    $('#contactDiv').html('<img src="/themes/wines/images/loading.gif" /> Loading...');
    $.ajax({
        url: "/contact/ContactForm",
        data: data+"&g-recaptcha-response="+recaptcha,
        type: "POST",
        success: function (data) {
            $('#contactDiv').html(data);
            if (data == 'Thanks for contacting us!')
            	$('#Form_ContactForm').find('input,textarea').attr('disabled','true');
            else
            	grecaptcha.reset(recaptcha2);
        }
    })
    event.preventDefault();
});