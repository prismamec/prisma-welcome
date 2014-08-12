<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 12-08-2014
  * Version: 0.02
  *
  *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
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
  $page_path="server/ajax/welcome/get_welcome";
  debug_log("[".$page_path."] START");
  $response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/
  // SYSTEM CLOSED
  if(!checkClosed()){echo json_encode($response);die();}

  // BD CONNECTION
  if(!checkBDConnection()){echo json_encode($response);die();}

  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  $response["result"]=true;

  $response["data"]["page-data"]="
  <div class='page-container padding-20'>
    <div class='page-content'>
      <div class='content'>
        <div class='row m-b-20'>
          <div class='col-md-3'>
          </div>
          <div class='col-md-6'>
            <div class='grid simple'>
              <div class='grid-body text-center'>
                <div>
                  <i class='fa fa-circle'></i>
                </div>
                <h1>".$s["welcome_to_prisma"]."</h1>
                <p>
                  Con prisma no tendrás que preocuparte por tus datos, gracias a nuestro<br/>
                  de recuperación tanto local como Cloud, pase lo que pase tus datos<br/>
                  siempre estarán disponibles.
                </p>
                <div class='row'>
                  <div class='col-md-6'>
                    <p><i class='fa fa-edit fa-4x'></i></p>
                    <p><a href='../signup/' class='btn btn-primary btn-large'>Crear nuevo</a></p>
                  </div>
                  <div class='col-md-6'>
                    <p><i class='fa fa-magic fa-4x'></i></p>
                    <p><a href='../recovery/' class='btn btn-primary btn-large'>Recuperar datos</a></p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class='col-md-3'>
        </div>
      </div>
    </div>
  </div>";



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
