<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 13-08-2014
  * Version: 0.03
  *
  *********************************************************/

  /*********************************************************
  * AJAX RETURNS
  *
  * ERROR CODES
  * system_closed
  * db_connection_error
  * no_user
  * user_not_valid
  * user_inactive
  * session_expired
  * sessionkey_expired
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
  if(!checkClosed()){echo "jsonCallback(".json_encode($response).")";die();}

  // BD CONNECTION
  if(!checkBDConnection()){echo "jsonCallback(".json_encode($response).")";die();}

  // USER
  if(!checkUser($_GET)){echo "jsonCallback(".json_encode($response).")";die();}

  /*********************************************************
  * AJAX OPERATIONS
  *********************************************************/

  $response["result"]=true;

  $table="users";
  $filter=array();
  $filter["id_user"]=array("operation"=>"=","value"=>$_GET["id_user"]);
  $user=getInBD($table,$filter);

  $response["data"]["page-data"]="
  <div class='page-container padding-20'>
    <div class='page-content'>
      <div class='content'>
        <div class='row m-t-40'>
          <div class='col-md-2'>
          </div>
          <div class='col-md-8'>
            <div class='grid simple'>
              <div class='grid-body'>
                <div class='text-center'>
                  <div class='m-l-40 m-r-40 m-t-20'>
                    <img width='300px' src='../assets/img/logo.png'/>
                  </div>
                  <h3>".htmlentities($s["hello"].", ".$user["name"], ENT_QUOTES, "UTF-8", FALSE)."</h3>
                </div>
                <div class='row m-t-40'>
                  <div class='col-md-2'>
                  </div>
                  <div class='col-md-4 text-center'>
                    <p>
                      <a href='../recovery/index.html' class=''>
                        <img width='100px' src='../assets/img/recovery_icon.png'/>
                      </a>
                    </p>
                    <p>
                      <a href='../recovery/index.html'>".$s["storage_and_backups"]."</a>
                    </p>
                  </div>
                  <div class='col-md-4 text-center'>
                    <p class=''>
                      <a href='../softwarecenter/index.html' class=''>
                        <img width='100px' src='../assets/img/softwarecenter.png'/>
                      </a>
                    </p>
                    <p class=''>
                      <a href='../softwarecenter/index.html'>".$s["software_center"]."</a>
                    </p>
                  </div>
                  <div class='col-md-2'>
                  </div>
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

  $table="users";
  $filter=array();
  $filter["id_user"]=array("operation"=>"=","value"=>$_GET["id_user"]);
  $data=array();
  $data["last_activity"]=$timestamp;
  updateInBD($table,$filter,$data);

  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  echo "jsonCallback(".json_encode($response).")";
  debug_log("[".$page_path."] END");
  die();

?>
