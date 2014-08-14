  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 16-08-2014
  * Version: 0.03
  *
  *********************************************************/
  $.ajax({
    type: 'GET',
    dataType: 'jsonp',
    jsonp: 'callback',
    jsonpCallback: 'jsonCallback',
    contentType: 'application/json',
    url: $SERVER_PATH+"server/ajax/signup/get_signup.php",
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
        $("#form-signup").submit(function(e){
              e.preventDefault();
        });

        $("#form-signup").validate({
          messages:{
            name:{
              required: $s["signup_name_this_field_is_compulsory"],
              maxlength: $s["signup_name_it_canot_be_longer_than_100_characters"],
              minlength: $s["signup_name_this_field_needs_4_character_minimum"]
            },
            email:{
              remote: $s["signup_email_this_email_is_already_registered"],
              required: $s["signup_email_this_field_is_compulsory"],
              email: $s["signup_email_format_is_not_correct"]
            },
            password:{
              required: $s["signup_password_this_field_is_compulsory"],
              maxlength: $s["signup_password_it_canot_be_longer_than_25_characters"],
              minlength: $s["signup_password_this_field_needs_8_character_minimum"]
            },
            repeat_password:{
              required:$s["signup_repeat_password_this_field_is_compulsory"],
              equalTo: $s["signup_repeat_password_both_passwords_do_not_coincide"]
            },
            accept_policy:{
              required: $s["signup_it_is_necessary_to accept_privacy_policy"],
            }
          },
          rules:{
            name:{
              required:true,
              maxlength: 100,
              minlength: 4
            },
            email:{
              remote:$SERVER_PATH+"server/ajax/signup/check_email_not_used.php",
              required:true,
              email: true
            },
            password:{
              required:true,
              maxlength: 25,
              minlength: 8
            },
            repeat_password:{
              required:true,
              equalTo:"#password"
            },
            accept_policy:{
              required: true
            }
          },
          submitHandler:function(form){
            $('#form-signup .form-error').remove();

            $.ajax({
              type: 'GET',
              jsonp: 'callback',
              async: false,
              dataType: 'jsonp',
              jsonpCallback: 'jsonCallback',
              contentType: 'application/json',
              url: $SERVER_PATH+"server/ajax/signup/add_signup.php",
              data: {
                "name":$('#form-signup #name').val(),
                "email":$('#form-signup #email').val(),
                "phone":$('#form-signup #phone').val(),
                "password":$('#form-signup #password').val()
              },
              error: function(data, textStatus, jqXHR) {
                form_error_handler("form-signup",$s_form_error["ajax_error"]);
              },
              success: function(response) {
                alert("ok");

                if(response.result){
                }else{
                  alert("error");
                  alert(response.error_code_str);
                  form_error_handler("form-signup",response.error_code_str);
                }
              }

            });
          }
        });
      }else{
        error_handler(response.error_code);
      }
    }
  });
