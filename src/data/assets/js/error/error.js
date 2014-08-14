  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 16-08-2014
  * Version: 0.03
  *
  *********************************************************/

  $(document).ready(function(){
    $.ajax({
      async: false,
      type: "GET",
      dataType: 'jsonp',
      jsonp: 'callback',
      jsonpCallback: 'jsonCallback',
      contentType: 'application/json',
      url: $SERVER_PATH+"server/ajax/error/get_error.php",
      data: {
        error_code: $GET["error_code"],
        lang: localStorage.getItem("lang")
      },
      error: function(data, textStatus, jqXHR) {
        //No handler
      },
      success: function(response) {
        if(response.result){
          jQuery.each(response.data,function(key,value){
             $(".ajax-loader-"+key).html(value);
          });
        }else{
          //No handler
        }
      }
    });
  });
