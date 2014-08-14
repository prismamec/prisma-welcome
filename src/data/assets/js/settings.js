/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 12-08-2014
* Version: 0.03
*
*********************************************************/

var $SERVER_PATH = $PATH;
//var $SERVER_PATH = "http://www.prismaos.com/prisma-welcome/";

var $config= new Array();
$config["company_phone"] = "+34 886 131 361";
$config["company_info_mail"] = "info@royappty.com";


if ((typeof localStorage.getItem('lang') == 'undefined')||(localStorage.getItem('lang') == null)){
  var navigatorLang = navigator.language || navigator.userLanguage;
  if(navigatorLang == 'es'){
    localStorage.setItem('lang','es'); require($PATH+"assets/js/lang/ES_es.js");
  }else{
    localStorage.setItem('lang','en'); require($PATH+"assets/js/lang/EN_en.js");
  }
}else if(localStorage.getItem('lang') == 'es'){
  localStorage.setItem('lang','es'); require($PATH+"assets/js/lang/ES_es.js");
}else{
  localStorage.setItem('lang','en'); require($PATH+"assets/js/lang/EN_en.js");
}

loadjscssfile($SERVER_PATH+"server/assets/css/server_style.css", "css");

(function (){
  window.$GET = [];
  if(location.search){
    var params = decodeURIComponent(location.search).match(/[a-z_]\w*(?:=[^&]*)?/gi);
    if(params){
      var pm, i = 0;
      for(; i < params.length; i++){
        pm = params[i].split('=');
        $GET[pm[0]] = pm[1] || '';
      }
    }
  }
})();
