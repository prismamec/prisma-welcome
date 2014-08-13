<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 12-08-2014
  * Version: 0.03
  *
  *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
  * system_closed
  * db_connection_error
  * post_login_no_email
  * post_login_no_password
  * login_not_valid
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS AND INCLUDES
  *********************************************************/

  define('PATH', str_replace('\\','/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/includes.php");
  $page_path="server/ajax/login/get_login";
  debug_log("[".$page_path."] START");
  $response=array();




  /*********************************************************
  * DATA CHECK
  *********************************************************/
  // SYSTEM CLOSED
  if(!checkClosed()){echo "jsonCallback(".json_encode($response).")";die();}

  // BD CONNECTION
  if(!checkBDConnection()){echo "jsonCallback(".json_encode($response).")";die();}

  //POST
  if(!@issetandnotempty($_GET["email"])){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR Data Missing email");
    $response["error_code"]="post_login_no_email";
    $response["error_code_str"]= $error_step_s["post_login_no_email"];
    echo "jsonCallback(".json_encode($response).")";
    die();
  }
  if(!@issetandnotempty($_GET["password"])){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR Data Missing password");
    $response["error_code"]="post_login_no_password";
    $response["error_code_str"]= $error_step_s["post_login_no_password"];
    echo "jsonCallback(".json_encode($response).")";
    die();
  }

  //CHECK LOGIN
  $table="users";
  $filter=array();
  $filter["email"]=array("operation"=>"=","value"=>$_GET["email"]);
  if(!isInBD($table,$filter)){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR User not valid");
    $response["error_code"]="login_not_valid";
    $response["error_code_str"]= $error_step_s["login_not_valid"];
    echo "jsonCallback(".json_encode($response).")";
    die();
  }
  $user=getInBD($table,$filter);
  error_log($user["hash"]);
  error_log(crypt($_GET["password"], $user["hash"]));

  if(crypt($_GET["password"], $user["hash"])!=$user["hash"]){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR User not valid");
    $response["error_code"]="login_not_valid";
    $response["error_code_str"]= $error_step_s["login_not_valid"];
    echo "jsonCallback(".json_encode($response).")";
    die();
  }
  if($user["active"]!=1){
    $response["result"]=false;
    debug_log("[".$page_path."] ERROR User not valid");
    $response["error_code"]="user_no_active";
    $response["error_code_str"]= $error_step_s["user_no_active"];
    echo "jsonCallback(".json_encode($response).")";
    die();
  }

  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  $response["result"]=true;


  /*********************************************************
  * DATABASE REGISTRATION
  *********************************************************/



  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  echo "jsonCallback(".json_encode($response).")";
  debug_log("[".$page_path."] END");
  die();

?>
