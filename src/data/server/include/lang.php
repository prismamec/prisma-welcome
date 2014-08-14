<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 12-08-2014
  * Version: 0.03
  *
  *********************************************************/

  $lang="ES_es";
  $lang_email = "es";
  if(@!issetandnotempty($_GET['lang'])){
    if(@!issetandnotempty($_SESSION['lang'])){
      $lang="EN_en";
      $lang_email = "en";
      $_GET["lang"]="en";
    }
    else{
      $_GET["lang"]=$_SESSION['lang_email'];
    }
  }
  if($_GET["lang"] == 'es'){
    $lang="ES_es";
    $lang_email = "es";
    $_SESSION["lang"]="ES_es";
    $_SESSION["lang_email"]="es";
  }
  else{
    $lang="EN_en";
    $lang_email = "en";
    $_SESSION["lang"]="EN_en";
    $_SESSION["lang_email"]="en";
  }
  unset($_GET["lang"]);
  include_once(PATH."lang/".$lang.".php");
?>
