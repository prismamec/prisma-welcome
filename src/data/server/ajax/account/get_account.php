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
  *
  *********************************************************/

  /*********************************************************
  * COMMON AJAX CALL DECLARATIONS AND INCLUDES
  *********************************************************/

  define('PATH', str_replace('\\','/','../../'));
  @session_start();
  $timestamp=strtotime(date("Y-m-d H:i:00"));
  include(PATH."include/includes.php");
  $page_path="server/ajax/account/get_account";
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
                  <h3>".htmlentities($s["hello"].", ".$user["name"], ENT_QUOTES, "UTF-8")."</h3>
                </div>
                <div class='row'>
                  <div class='col-md-1'>

                  </div>
                  <div class='col-md-3'>
                    <p class='m-l-40 m-r-40 text-center'>
                      <img width='100px' src='../assets/img/recovery.png'/>
                    </p>
                  </div>
                  <div class='col-md-3'>
                    <p class='m-l-40 m-r-40 text-center'>
                      <img width='100px' src='../assets/img/recovery.png'/>
                    </p>
                  </div>
                  <div class='col-md-3'>
                    <p class='m-l-40 m-r-40 text-center'>
                      <img width='100px' src='../assets/img/account.png'/>
                    </p>
                  </div>
                  <div class='col-md-1'>

                  </div>
                </div>
                    <div class=''>
                      <form id='form-login'>
                        <div class='form-group'>
                          <label class='form-label'>".htmlentities($login_s["email"], ENT_QUOTES, "UTF-8")."</label>
                          <span class='help'>".htmlentities($login_s["email_help"], ENT_QUOTES, "UTF-8")."</span>
                          <div class='controls'>
                            <input type='text' class='form-control' id='email' name='email'/>
                          </div>
                        </div>
                        <div class='form-group'>
                          <label class='form-label'>".htmlentities($login_s["password"], ENT_QUOTES, "UTF-8")."</label>
                          <span class='help'>".htmlentities($login_s["password_help"], ENT_QUOTES, "UTF-8")."</span>
                          <div class='controls'>
                            <input type='password' class='form-control' id='password' name='password'/>
                          </div>
                        </div>
                        <p class='text-right m-t-10'>
                          <a href='../recoverpass/index.html'>".$s["forgot_your_password?"]."</a>
                        </p>
                        <div class=''>
                          <input type='submit' class='btn btn-primary btn-block btn-large' value='".$s["access"]."'/>
                        </div>
                      </form>
                    </div>
                    <div class='m-t-10'>
                      <a href='../signup/index.html' class='btn btn-white btn-block'>".$s["signup"]."</a>
                    </div>
                  </div>
                  <div class='col-md-3'>
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



  /*********************************************************
  * AJAX CALL RETURN
  *********************************************************/

  echo "jsonCallback(".json_encode($response).")";
  debug_log("[".$page_path."] END");
  die();

?>
