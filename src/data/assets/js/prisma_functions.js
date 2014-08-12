  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 16-08-2014
  * Version: 0.03
  *
  *********************************************************/

  function require(script) {
      $.ajax({
          url: script,
          dataType: "script",
          async: false,
          success: function () {
          },
          error: function () {
          }
      });
  }
  function error_handler(error_code){
    error_block:{
      //if(error_code=="ajax_error"){window.location.href = $PATH+"error/?error_code=ajax_error";break error_block;}
      if(error_code=="system_closed"){window.location.href = $PATH+"closed/";break error_block;}
      if(error_code=="db_connection_error"){window.location.href = $PATH+"error/?error_code=db_connection_error";break error_block;}
      //Error Unknow
      //window.location.href =  $PATH+"error/?error_code=base";break error_block;
    }
  }
  function modal_error_handler(error_code){
    error_block:{
      if(error_code=="ajax_error"){set_modal("error-modal",$error_s["ajax_error_title"],$error_s["ajax_error_content"],$s["close"],"#");break error_block;}
      if(error_code=="db_connection_error"){set_modal("error-modal",$error_s["db_connection_error_title"],$error_s["db_connection_error_content"],$s["close"],"#");break error_block;}
      //Error Unknow
      window.location.href =  $PATH+"error/?error_code=base";break error_block;

    }
  }
  function set_modal(id_modal,title,content,button,accept_action){
    $("#"+id_modal+" #modal-title").html(title);
    $("#"+id_modal+" #modal-content").html(content);
    $("#"+id_modal+" #modal-button").html(button);
    $('.modal').modal('hide');
    $("#"+id_modal).modal();
    $("#"+id_modal+" .accept_button").attr("href",accept_action);

  }
  function input_only_numbers(id_field){
  	if(isNaN($("#"+id_field).val())){
  		$("#"+id_field).val(0);
  	}
  }
  function loadjscssfile(filename, filetype){
   if (filetype=="js"){ //if filename is a external JavaScript file
    var fileref=document.createElement('script')
    fileref.setAttribute("type","text/javascript")
    fileref.setAttribute("src", filename)
   }
   else if (filetype=="css"){ //if filename is an external CSS file
    var fileref=document.createElement("link")
    fileref.setAttribute("rel", "stylesheet")
    fileref.setAttribute("type", "text/css")
    fileref.setAttribute("href", filename)
   }
   if (typeof fileref!="undefined")
    document.getElementsByTagName("head")[0].appendChild(fileref)
  }
