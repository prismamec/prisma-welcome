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
  $page_path="server/ajax/signup/get_signup";
  debug_log("[".$page_path."] START");
  $response=array();

  /*********************************************************
  * DATA CHECK
  *********************************************************/
  
  // SYSTEM CLOSED
  if(!checkClosed()){echo "jsonCallback(".json_encode($response).")";die();}

  // BD CONNECTION
  if(!checkBDConnection()){echo "jsonCallback(".json_encode($response).")";die();}

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
              <div class='grid-body'>
                <div class='text-center'>
                  <div class='m-l-40 m-r-40 m-t-20'>
                    <img width='300px' src='../assets/img/logo.png'/>
                  </div>
                  <h3>".htmlentities($s["signup"], ENT_QUOTES, "UTF-8", FALSE)."</h3>
                  <p class='m-l-40 m-r-40'>".htmlentities($s["signup_help"], ENT_QUOTES, "UTF-8", FALSE)."</p>
                  </p>
                </div>
                <div class='m-l-20 m-r-20'>
                  <form id='form-signup'>
                  	<div class='form-group'>
    									<label class='form-label'>".htmlentities($signup_s["name"], ENT_QUOTES, "UTF-8", FALSE)."</label>
    									<span class='help'>".htmlentities($signup_s["name_help"], ENT_QUOTES, "UTF-8", FALSE)."</span>
    									<div class='controls'>
                        <input type='text' class='form-control' id='name' name='name'/>
    									</div>
    								</div>
                    <div class='form-group'>
                      <label class='form-label'>".htmlentities($signup_s["email"], ENT_QUOTES, "UTF-8", FALSE)."</label>
                      <span class='help'>".htmlentities($signup_s["email_help"], ENT_QUOTES, "UTF-8", FALSE)."</span>
                      <div class='controls'>
                        <input type='text' class='form-control' id='email' name='email'/>
                      </div>
                    </div>
                    <div class='form-group'>
                      <label class='form-label'>".htmlentities($signup_s["phone"], ENT_QUOTES, "UTF-8", FALSE)."</label>
                      <span class='help'>".htmlentities($signup_s["phone_help"], ENT_QUOTES, "UTF-8", FALSE)."</span>
                      <div class='controls'>
                        <input type='text' class='form-control' id='phone' name='phone'/>
                      </div>
                    </div>
                    <div class='form-group'>
                      <label class='form-label'>".htmlentities($signup_s["password"], ENT_QUOTES, "UTF-8", FALSE)."</label>
                      <span class='help'>".htmlentities($signup_s["password_help"], ENT_QUOTES, "UTF-8", FALSE)."</span>
                      <div class='controls'>
                        <input type='password' class='form-control' id='password' name='password'/>
                      </div>
                    </div>
                    <div class='form-group'>
                      <label class='form-label'>".htmlentities($signup_s["repeat_password"], ENT_QUOTES, "UTF-8", FALSE)."</label>
                      <span class='help'>".htmlentities($signup_s["repeat_password_help"], ENT_QUOTES, "UTF-8", FALSE)."</span>
                      <div class='controls'>
                        <input type='password' class='form-control' id='repeat_password' name='repeat_password'/>
                      </div>
                    </div>
                    <div class='form-checkbox'>
                        <input type='checkbox' value='1' id='accept_policy' name='accept_policy'> ".$signup_s["i_read_and_acept"]." <a href=''>".$signup_s["usage_policy"]."
                    </div>
                    <input type='hidden' id='sessionkey' value=''/>
                    <div class='text-center'>
                      <a href='../login/index.html' class='btn btn-white margin-10'>".$s["cancel"]."</a>
                      <input type='submit' class='btn btn-primary margin-10' value='".$s["signup"]."'/>
                    </div>
                  </form>
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
