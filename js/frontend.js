/* Einstellungen für JQuery-Validation*/
$().ready(function(){

	$.validator.addMethod("specChar", function(value, element){
		return this.optional(element) || /^[a-zA-Z0-9\.\_]+$/i.test(value);
	}, 'Keine Sonderzeichen erlaubt.');
	
	$("#registration-form").validate({
		/* Hier werden die Werte für die Validierung gesetzt */
		rules: {
		    firstname: {
		    	required: true,
		    	specChar: true
		    },
		    lastname: {
		    	required: true,
		    	specChar: true
		    },
		    username: {
		    	required: true,
		    	minlength: 2,
		    	specChar: true
		    },
		    email: {
		    	required: true,
		     	email: true
		    },
		    password: {
		    	required: true,
		    	minlength: 6,
		    },
		    confirm_password: {
		    	equalTo: "#password"
		    },
		    agree: "required" /* Abkürzung für agree:{required:true} */
		  }
		});
	$("#login-form").validate({
		/* Hier werden die Werte für die Validierung gesetzt */
		rules: {
			username: {
				required: true,
				minlength: 2,
				specChar: true
			},
			password: {
				required: true,
				minlength: 6,
			}
		}
	});
	$('#comment-form').validate({
		rules: {			
			comment: {
				required: true,
				minlength: 2
			}
		}
	});
	$('#adduser-form').validate({
		rules: {			
			name: {
				minlength: 2
			},
			lastname: {
				minlength: 2
			}
		}
	});
	$('#event-form').validate({
		rules: {			
			title: {
				required: true,
				minlength: 2
			},
			description: {
				minlength: 2
			},
			start: {
				required: true
			},
			end: {
				required: true
			}
		}
	});
	
	/* Erstellt automatisch ein Benutzernamen aus dem bereits eingegeben Vor- und Nachnamen */
	$("#username").focus(function(){
		var firstname = $("#firstname").val();
		var lastname = $("#lastname").val();
		if(firstname && lastname && !this.value){
			this.value = firstname + "." + lastname;
		}
	});
	
	
});