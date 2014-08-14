  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 16-08-2014
  * Version: 0.03
  *
  *********************************************************/

  $(document).ready(function(){
    alert(localStorage.getItem("recover_mode"));
    $.ajax({
      async: false,
      type: "GET",
      dataType: 'jsonp',
      jsonp: 'callback',
      jsonpCallback: 'jsonCallback',
      contentType: 'application/json',
      url: $SERVER_PATH+"server/ajax/recovery/start/get_start.php",
      data: {
        id_user: localStorage.getItem("id_user"),
        sessionkey: localStorage.getItem("sessionkey"),
        recover_mode: localStorage.getItem("recover_mode"),
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
