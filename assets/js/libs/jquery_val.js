$(function () {
	$("#form").validate({
		rules: {
            voornaam: "required",
            achternaam: "required",
            email: {
                required: true,
                email: true
			},
			adres: "required",
			plaats: "required",
			postcode: "required",
			tel: "required",
			geboortedatum: "required"
		},
		errorClass: "invalid",
		errorPlacement: function(error, element) {
	    	return true;
	    },
		submitHandler: function(form) {
            form.submit();
        },
        invalidHandler: function(event, validator) {
	    var errors = validator.numberOfInvalids();
	    if (errors) {
	      var message = errors == 1
	        ? '1 veld is niet correct ingevuld.'
	        : errors + ' velden zijn niet correct ingevuld.';
	      $("div#error_msgs").html(message);
	      $("div#error_msgs").show();
	    } else {
	      $("div#errormsgs").hide();
	    }
	  }
	});
    $(".ouder").css("display", "none");
    $("input[type='checkbox']").click(function(){
    	if($('#op').is(':checked') || $('#bp').is(':checked')) {
            $(".ouder").css("display", "block");
            $(".ouder #ouderna").rules('add', 'required');
            $(".ouder #oudervoor").rules('add', 'required');
        }
        else {
        	$(".ouder").css("display", "none");
        	$(".ouder #ouderna").rules('remove', 'required');
        	$(".ouder #oudervoor").rules('remove', 'required');
        }
    });
});