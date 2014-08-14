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
	* ERROR CODES // form_error_handler
	* db_connection_error
	*	post_no_account_name
	*	post_no_account_email
	*	post_no_account_password
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/
	define('PATH', str_replace('\\', '/','../../'));
	@session_start();
	$timestamp=strtotime(date("Y-m-d H:i:00"));
	include(PATH."include/includes.php");
	$page_path = "server/app/ajax/accounts/signup/add_account";
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
	if(!@issetandnotempty($_GET["name"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing name");
		$response["error_code"]="post_signup_no_name";
		$response["error_code_str"]= $error_code_s["post_signup_no_name"];
		echo "jsonCallback(".json_encode($response).")";
		die();
	}
	if(!@issetandnotempty($_GET["email"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing email");
		$response["error_code"]="post_signup_no_email";
		$response["error_code_str"]= $error_step_s["post_signup_no_email"];
		echo "jsonCallback(".json_encode($response).")";
		die();
	}
	if(!@issetandnotempty($_GET["password"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Post Missing password");
		$response["error_code"]="post_signup_no_password";
		$response["error_code_str"]= $error_step_s["post_signup_no_password"];
		echo "jsonCallback(".json_encode($response).")";
		die();
	}


	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/


	$response["result"]=true;

	$table="users";
	$data=array();
	$data["name"]=$_GET["name"];
  $data["email"]=$_GET["email"];
  $data["phone"]=$_GET["phone"];
	$salt = substr(base64_encode(openssl_random_pseudo_bytes('30')), 0, 22);
	$salt = strtr($salt, array('+' => '.'));
	$hash = crypt($_GET["password"],$salt);
  $data["hash"]=$hash;
	$data["active"]=1;
  $data["created"]=$timestamp;
  addInBD($table,$data);

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/


	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

	debug_log("[".$page_path."] END");
 	echo "jsonCallback(".json_encode($response).")";
	die();

?>
