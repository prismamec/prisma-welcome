<?php
/*********************************************************
*
* Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
* Last Edit: 08-08-2014
* Version: 0.94
*
*********************************************************/

// Image resize function with php + gd2 lib
function imageresize($source, $destination, $width = 0, $height = 0, $crop = false, $quality = 100) {
	$quality = $quality ? $quality : 80;
	$image = imagecreatefromstring($source);
	if ($image) {
			// Get dimensions
			$w = imagesx($image);
			$h = imagesy($image);
			if (($width && $w > $width) || ($height && $h > $height)) {
					$ratio = $w / $h;
					if (($ratio >= 1 || $height == 0) && $width && !$crop) {
							$new_height = $width / $ratio;
							$new_width = $width;
					} elseif ($crop && $ratio <= ($width / $height)) {
							$new_height = $width / $ratio;
							$new_width = $width;
					} else {
							$new_width = $height * $ratio;
							$new_height = $height;
					}
			} else {
					$new_width = $w;
					$new_height = $h;
			}
			$x_mid = $new_width * .5;  //horizontal middle
			$y_mid = $new_height * .5; //vertical middle
			// Resample
			$new = imagecreatetruecolor(round($new_width), round($new_height));
			imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
			// Crop
			if ($crop) {
					$crop = imagecreatetruecolor($width ? $width : $new_width, $height ? $height : $new_height);
					imagecopyresampled($crop, $new, 0, 0, ($x_mid - ($width * .5)), 0, $width, $height, $width, $height);
					//($y_mid - ($height * .5))
			}
			// Output
			// Enable interlancing [for progressive JPEG]
			imageinterlace($crop ? $crop : $new, true);

			$dext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
			if ($dext == '') {
					$dext = $ext;
					$destination .= '.' . $ext;
			}
			switch ($dext) {
					case 'jpeg':
					case 'jpg':
							imagejpeg($crop ? $crop : $new, $destination, $quality);
							break;
					case 'png':
							$pngQuality = ($quality - 100) / 11.111111;
							$pngQuality = round(abs($pngQuality));
							imagepng($crop ? $crop : $new, $destination, $pngQuality);
							break;
					case 'gif':
							imagegif($crop ? $crop : $new, $destination);
							break;
			}
			@imagedestroy($image);
			@imagedestroy($new);
			@imagedestroy($crop);
	}
}

function corporate_email($mail_for,$mail_subject,$content){
	global $url_server;
	global $CONFIG;
	global $lang_email;
	global $s;
	global $page_path;

	$mail_content ="
		<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
		<html  b:version='2' class='v2' expr:dir='data:blog.languageDirection' xmlns='http://www.w3.org/1999/xhtml' dir='ltr' lang='".$lang_email."' xml:lang='".$lang_email."' xmlns:b='http://www.google.com/2005/gml/b' xmlns:b='http://www.google.com/2005/gml/b' xmlns:data='http://www.google.com/2005/gml/data' xmlns:expr='http://www.google.com/2005/gml/expr' xmlns:og='http://opengraphprotocol.org/schema/'>
		<head>
			<meta http-equiv='content-type' content='text/html; charset=utf-8' />
		</head>
		<style type='text/css'>
			a{ color:color:#666; }
			a:hover{ color:#000; }
			b{ color:#000; font-weight:300 }
			.important{ color:#000; }
			.uppercase{ text-transform: uppercase; }
			.underline{ text-decoration:underline; }
			th{}
			td{ padding:5px 10px; }
			.preview img{ height:100px; }
			.right{ text-align:right; }
			.left{ text-align:left; }
			.semifooter{ padding-top:20px; font-size:10px; }
			h3{ font-size:14px; color:#000; font-weight:300}
		</style>
		<body style='font-family: \"Open Sans\", sans-serif;margin:0;padding:0'>
			<div style='display:block;margin:auto;margin:20px 0px 30px 0px;text-align:center'>
				<img style='margin:auto;min-width:300px;max-width:300px' src='".$url_server.$CONFIG["company_logo_path"]."'/>
			</div>
			<div class='content' style='margin:20px 20px 40px 20px;font-weight:100;font-size:14px;'>
			".$content."
			</div>

			<div style='display:block;margin:auto;padding:40px 0px;background-color:#f4f4f4;overflow:auto;color:#666 !important;font-size:10px;'>
				<div style='float:left;padding-left:20px;padding-bottom:10px;'>
					<div>
						<a href='http://www.okycoky.net/classics/'>
							<img style='min-height:30px;max-height:30px;padding-bottom:10px;' src='".$url_server.$CONFIG["company_logo_path"]."'/>
						</a>
					</div>
					".$CONFIG["company_street"]."<br/>
					".$CONFIG["company_town"]." ".$CONFIG["company_country"]."<br/>
					".$CONFIG["company_phone"]."<br/>
					".$CONFIG["company_info_mail"]."<br/>
				</div>
				<div style='float:right;padding-right:20px;text-align:right;width:300px;font-size:11px;padding-bottom:10px;'>
					<div style='font-weight:bold'>".htmlentities($s["follow_us"], ENT_QUOTES, "UTF-8")."</div>
					<div style='text-align:right;margin-top:5px;'>
						".htmlentities($s["follow_us_in_social_networks"], ENT_QUOTES, "UTF-8")."
					</div>
				</div>
			</div>
			<div style='text-align:center;background:#fff;padding:20px;font-weight:100;font-size:12px;'>
				<p>".date('Y').htmlentities(" © ".$CONFIG["company_name"], ENT_QUOTES, "UTF-8")."</p>
				<p>".$CONFIG["footer_mail"]."</p>
			</div>
		</body>
		</html>";
		$mail_header="Content-type: text/html\r\nFrom: ".$CONFIG["mail_header_email"];
		debug_log("[".$page_path."] Send corportate email (for:".$mail_for.",subject:".$mail_subject.") START");
		mail($mail_for,$mail_subject,$mail_content,$mail_header);
		debug_log("[".$page_path."] Send corportate email END");
		return true;
}

function checkClosed(){
	global $page_path;
	global $response;
	global $CONFIG;

	if($CONFIG["close"]){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR System Closed");
		$response["error"]="ERROR System Closed";
		$response["error_code"]="system_closed";
		$response["error_code_str"]= htmlentities($error_code_s["system_closed"], ENT_QUOTES, "UTF-8");
		return false;
		die();
	}

	return true;
	die();
}

function checkBDConnection(){
	global $response;
	global $db_connection;

	if(!$db_connection["status"]){
		error_log("FALSE");
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Can't connect with DataBase");
		$response["error"]="ERROR Can't connect with DataBase";
		$response["error_code"]="db_connection_error";
		$response["error_code_str"]= htmlentities($error_code_s["db_connection_error"], ENT_QUOTES, "UTF-8");
		return false;
		die();
	}

	return true;
	die();
}

function checkUser($user){
	global $page_path;
	global $response;
	global $error_code_s;

	if(!@issetandnotempty($user["id_user"])){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Data Missing id_user");
		$response["error"]="ERROR Data Missing user identificator";
		$response["error_code"]="no_user";
		$response["error_code_str"]= htmlentities($error_code_s["no_user"], ENT_QUOTES, "UTF-8");
		return false;
		die();
	}

	$table="users";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR User not exists (id_user=".$user["id_user"].")");
		$response["error"]="ERROR User not in the system";
		$response["error_code"]="user_not_valid";
		$response["error_code_str"]= htmlentities($error_code_s["user_not_valid"], ENT_QUOTES, "UTF-8");
		return false;
		die();
	}

	$table="users";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	$filter["active"]=array("operation"=>"=","value"=>1);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR user inactive (id_user=".$user["id_user"].")");
		$response["error"]="ERROR User inactive";
		$response["error_code"]="user_inactive";
		$response["error_code_str"]= htmlentities($error_code_s["user_inactive"], ENT_QUOTES, "UTF-8");
		return false;
		die();
	}

	$table="users";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	$filter["sessionkey"]=array("operation"=>"=","value"=>$user["sessionkey"]);
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR SessionKey expired");
		$response["error"]="ERROR Sessionkey expired";
		$response["error_code"]="sessionkey_expired";
		$response["error_code_str"]= htmlentities($error_code_s["sessionkey_expired"], ENT_QUOTES, "UTF-8");
		return false;
		die();
	}

	$table="users";
	$filter=array();
	$filter["id_user"]=array("operation"=>"=","value"=>$user["id_user"]);
	$filter["last_activity"]=array("operation"=>">","value"=>strtotime("-15 minutes"));
	if(!isInBD($table,$filter)){
		$response["result"]=false;
		debug_log("[".$page_path."] ERROR Session expired");
		$response["error"]="ERROR Session expired";
		$response["error_code"]="session_expired";
		$response["error_code_str"]= htmlentities($error_code_s["session_expired"], ENT_QUOTES, "UTF-8");

		return false;
		die();
	}
	return true;
	die();
}

function error_handler($error_code){
	global $error_alert;
	global $error_s;

	if((isset($error_code))&&(!empty($error_code))&&($error_code!="undefined")){
		$error_alert=$error_s[$error_code];
	}
}


?>
