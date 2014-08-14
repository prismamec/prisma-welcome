  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 13-08-2014
  * Version: 0.03
  *
  *********************************************************/

  $(document).ready(function(){
    $.ajax({
      async: false,
      type: 'GET',
      dataType: 'jsonp',
      jsonp: 'callback',
      jsonpCallback: 'jsonCallback',
      contentType: 'application/json',
      url: $SERVER_PATH+"server/ajax/account/get_account.php",
      data: {
        id_user: localStorage.getItem("id_user"),
        sessionkey: localStorage.getItem("sessionkey"),
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
  });
