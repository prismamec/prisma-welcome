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

  define('PATH', str_replace('\\','/','../../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/includes.php");
  $page_path="server/ajax/recovery/local/get_local";
  debug_log("[".$page_path."] START");
  $response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/
  // SYSTEM CLOSED
  if(!checkClosed()){echo "jsonCallback(".json_encode($response).")";die();}

  // BD CONNECTION
  if(!checkBDConnection()){echo "jsonCallback(".json_encode($response).")";die();}

  foreach($_GET as $key => $value){
    error_log($key." ".$value);
  }
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

  $recovers=array();
  $recovers["1"]["id_recover"] = 1;
  $recovers["1"]["path"] = "\/recover\/1.img";
  $recovers["1"]["created"] = date("d-m-Y H:m",strtotime("-2 days"));
  $recovers["1"]["size"] = rand(10,20);
  $recovers["2"]["id_recover"] = 2;
  $recovers["2"]["path"] = "\/recover\/1.img";
  $recovers["2"]["created"] = date("d-m-Y H:m",strtotime("-3 days"));
  $recovers["2"]["size"] = rand(8,10);

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
                    <img width='300px' src='../../assets/img/logo.png'/>
                  </div>
                  <p class='m-t-20'>
                    <img class='m-l-10 m-r-10' width='100px' src='../../assets/img/recovery_icon.png'/>
                    <img class='m-l-10 m-r-10' width='100px' src='../../assets/img/recovery_local_icon.png'/>
                  </p>
                  <h3>".htmlentities($s["recovery_local"], ENT_QUOTES, "UTF-8")."</h3>
                  <p>".htmlentities($s["recovery_local_help"], ENT_QUOTES, "UTF-8")."</p>
                </div>
                <div class='row m-t-20'>
                  <div class='col-md-2'>
                  </div>
                  <div class='col-md-8 text-center'>
                    <div class='grid simple'>
                      <div class='grid-body'>
                        <form id='recovery-form'>";
  foreach ($recovers as $key => $recover){
    $response["data"]["page-data"].="
                          <div class='radio text-left'>
                            <input id='".$recover["id_recover"]."' type='radio' name='id_recover' value='".$recover["id_recover"]."'>
                            <label for='".$recover["id_recover"]."' class=' m-t-10'>
                              <i class='fa fa-rotate-left'></i> ".$s["backup"]." ".$recover["created"]." ( ".$recover["size"]." Gb )</label>
                          </div>
    ";
  }
  $response["data"]["page-data"].="
                          <div class='m-t-20'>
                            <input type='submit' class='btn btn-primary' value='".$s["start_recover"]."'/>
                          </div>
                        </form>
                      </div>
                      <p class='m-t-20'>
                        <a href='../index.html' class='btn btn-white'>".$s["back"]."</a>
                      </p>
                    </div>

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
