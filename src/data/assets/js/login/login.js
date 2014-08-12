/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 12-08-2014
* Version: 0.03
*
*********************************************************/

$SERVER_PATH="./"

$(document).ready(function() {
	$("#form").submit(function(e){
        e.preventDefault();
	});

	$("#form").validate({
		rules:{
			email:{
		  		required:true,
			  	email: true
		  	},
		  password:{
					required:true,
			  	maxlength: 25,
			  	minlength: 4
			}
		},
		submitHandler:function(form){
		 	$.ajax({
				type: "POST",
				jsonp: 'callback',
		    async: false,
				dataType: 'jsonp',
		    jsonpCallback: 'jsonCallback',
        contentType: 'application/json',
				url: $SERVER_PATH+"prisma-welcome/create_session.php",
				data: {
					"email":$('#form #email').val(),
					"password":$('#form #password').val()
				},
				error: function(data, textStatus, jqXHR) {
					alert("ajax_error"+data+" "+textStatus+" "+jqXHR);
				},
				success: function(response) {
					alert(response);

				}

			});
		}
	});

});
