/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 12-08-2014
* Version: 0.03
*
*********************************************************/

$(document).ready(function(){
	$.ajax({
		async: false,
		type: "POST",
		dataType: 'jsonp',
		jsonp: 'callback',
		jsonpCallback: 'jsonCallback',
		contentType: 'application/json',
		url: $SERVER_PATH+"server/ajax/login/get_login.php",
		data: {
			lang: localStorage.getItem("lang")
		},
		error: function(data, textStatus, jqXHR) {
			error_handler("ajax_error");
		},
		success: function(response) {
			if(response.result){
				jQuery.each(response.data,function(key,value){
					$(".ajax-loader-"+key).html(value);
				});
			}else{
				error_handler(response.error_code);
			}
		}
	});

	$("#form-login").submit(function(e){
				e.preventDefault();
	});

	$("#form-login").validate({
		messages:{
			email:{
				required: $s["login_email_this_field_is_compulsory"],
				email: $s["login_email_format_is_not_correct"]
			},
			password:{
				required: $s["login_password_this_field_is_compulsory"]
			}
		},
		rules:{
			email:{
				required:true,
				email: true
			},
			password:{
				required:true
			}
		},
		submitHandler:function(form){
			$('#form-login .form-error').remove();

			$.ajax({
				type: 'GET',
				jsonp: 'callback',
		    async: false,
				dataType: 'jsonp',
		    jsonpCallback: 'jsonCallback',
				contentType: 'application/json',
				url: $SERVER_PATH+"server/ajax/login/check_login.php",
				data: {
					"email":$('#form-login #email').val(),
					"password":$('#form-login #password').val()
				},
				error: function(data, textStatus, jqXHR) {
					form_error_handler("form-login",$s_form_error["ajax_error"]);
				},
				success: function(response) {
					if(response.result){
						localStorage.setItem('id_user',response.data.id_user);
						localStorage.setItem('sessionkey',response.data.sessionkey);
						window.location.href = "../account/index.html";
					}else{
						form_error_handler("form-login",response.error_code_str);
					}
				}

			});
		}
	});
});
