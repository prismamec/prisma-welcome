<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 17-07-2014
	* Version: 0.93
	*
	*********************************************************/

	/*********************************************************
	* AJAX RETURNS
	*
	* ERROR CODES
	* db_connection_error
	*
	*
	*
	*********************************************************/

	/*********************************************************
	* COMMON AJAX CALL DECLARATIONS AND INCLUDES
	*********************************************************/

  define('PATH', str_replace('\\','/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/includes.php");
  $page_path="server/ajax/signup/check_email_not_used";
  debug_log("[".$page_path."] START");
  $response=array();


	/*********************************************************
	* DATA CHECK
	*********************************************************/

	// SYSTEM CLOSED
  if(!checkClosed()){echo "jsonCallback(".json_encode($response).")";die();}

  // BD CONNECTION
	if(!checkBDConnection()){echo "jsonCallback(".json_encode($response).")";die();}


	$table="users";
	$filter=array();
	$filter["email"]=array("operation"=>"=","value"=>$_GET["email"]);

	if(isInBD($table,$filter)){
		$response="false";
	}else{
		$response="true";
	}

	/*********************************************************
	* AJAX OPERATIONS
	*********************************************************/

	/*********************************************************
	* DATABASE REGISTRATION
	*********************************************************/

	/*********************************************************
	* AJAX CALL RETURN
	*********************************************************/

  echo $response;
	debug_log("[".$page_path."] END");
	die();



?>
