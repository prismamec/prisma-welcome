<?php
	/*********************************************************
	*
	* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
	* Last Edit: 12-08-2014
	* Version: 0.03
	*
	*********************************************************/

	include_once(PATH."include/settings.php");
	include_once(PATH."include/bd.php");
	include_once(PATH."include/general.php");
	include_once(PATH."include/prisma_functions.php");
	include_once(PATH."include/lang.php");
	include_once(PATH."include/inbd.php");

	$table="config";
	$filter=array();
	$filter["used"]=array("operation"=>"=","value"=>"1");
	$CONFIG=getInBD($table,$filter);

?>
