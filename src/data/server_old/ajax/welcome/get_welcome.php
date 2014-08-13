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
        <div class='row m-t-40'>
          <div class='col-md-2'>
          </div>
          <div class='col-md-8'>
            <div class='grid simple'>
              <div class='grid-body text-center'>
                <div class='m-l-40 m-r-40 m-t-20'>
                  <img width='400px' src='../assets/img/logo.png'/>
                </div>
                <h2>".$s["recovery_system"]."</h2>
                <div class='m-l-40 m-r-40 m-t-20 m-b-40'>
                  <img width='200px' src='../assets/img/recovery.png'/>
                </div>
                <p>
                  Queremos que tus datos siempre estén a salvo. Configura un nuevo sistema<br/>
                  de recuperación para que tus datos siempre estén disponibles<br/>
                  o recupera tus datos si ya los tenías almacenados.
                </p>
                <div class='text-center'>
                  <a href='../signup/' class='btn btn-white btn-large margin-10'>Crear nuevo</a>
                  <a href='../recovery/' class='btn btn-white btn-large margin-10'>Recuperar datos</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class='col-md-2'>
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
