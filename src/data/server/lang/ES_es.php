<?php
  /*********************************************************
  *
  * Author: Pablo Gutierrez Alfaro <pablo@royappty.com>
  * Last Edit: 12-08-2014
  * Version: 0.03
  *
  *********************************************************/

  //General
  $s["cancel"] = "Cancelar";
  $s["back"] = "Volver";

  //Welcome
  $s["recovery_system"] = "Sistema de recuperación";
  $s["recovery_system_help"] = "Queremos que tus datos y aplicaciones siempre estén a salvo. Configura un nuevo sistema de recuperación para que tus datos siempre estén disponibles o recupera tus datos si ya los tenías almacenados.";
  $s["recovery_data"] = "Recuperar datos";

  //Activate System
  $s["activate_system"] = "Activar sistema";
  $s["activate_system_help"] = "Para activar el sistema de recuperación es necesario crear una cuenta PrismaOS, que le permita acceder a su sistema de recuperación en cualquier momento";
  $s["i_have_an_account"] = "Ya tengo cuenta";

  //Signup
  $s["signup"] = "Crear nueva cuenta";
  $s["signup_help"] = "Rellena el siguiente formulario para darte de alta";
  $signup_s["name"] = "Nombre";
  $signup_s["name_help"] = "Introduce tu nombre";
  $signup_s["email"] = "Correo Electrónico";
  $signup_s["email_help"] = "Introduce tu correo electrónico";
  $signup_s["phone"] = "Teléfono de contacto";
  $signup_s["phone_help"] = "Ej.: +34 600 000 000";
  $signup_s["password"] = "Contraseña";
  $signup_s["password_help"] = "Mínimo 6 caracteres";
  $signup_s["repeat_password"] = "Repetir contraseña";
  $signup_s["repeat_password_help"] = "";
  $signup_s["i_read_and_acept"] = "He leido y acepto la";
  $signup_s["usage_policy"] = "política de uso";
  $error_code_s["post_signup_no_name"] = "El campo nombre es obligatirio";
  $error_code_s["post_signup_no_email"] = "El campo correo electrónico es obligatirio";
  $error_code_s["post_signup_no_password"] = "El campo contraseña es obligatirio";

  //Login
  $s["login"] = "Accede a tu cuenta";
  $s["login_help"] = "Introduce tu nombre de correo electrónico y contraseña";
  $login_s["email"] = "Correo Electrónico";
  $login_s["email_help"] = "";
  $login_s["password"] = "Contraseña";
  $login_s["password_help"] = "";
  $s["forgot_your_password?"] = "He olvidado mi contraseña";
  $s["access"] = "Acceder";
  $error_code_s["post_login_no_email"] = "El campo correo electrónico es obligatirio";
  $error_code_s["post_login_no_password"] = "El campo contraseña es obligatirio";
  $error_step_s["login_not_valid"] = "Correo electrónico o contraseña no válida";
  $error_step_s["user_no_active"] = "Este usuario está bloqueado, contacte con nosotros";

  //Account
  $s["hello"] = "Hola";
  $s["storage_and_backups"] = "Almacenamiento y copias de seguridad";
  $s["software_center"] = "Centro de Software";

  //Recovery
  $s["recovery_local"] = "Copia de seguridad en disco duro local";
  $s["recovery_cloud"] = "Copia de seguridad en Prisma cloud";
  //Error
  $s["error"] = "Ha ocurrido un error";

  //Error strings
  $error_code_s["base"] = "Ha occurido un error desconocido en nuestro sistema, por favor vuelva a intentarlo más tarde.";
  $error_code_s["system_closed"] = "Se han bloqueado las peticiones al servidor en estos momentos, por favor vuelva a intentarlo más tarde";
  $error_code_s["db_connection_error"] = "Nuestro servidor está pasando por dificultades, por favor vuelva a intentarlo más tarde";
  $error_code_s["no_user"] = "No se ha podido identificar su usuario, por favor vuelva a loguarse e inténtelo de nuevo";
  $error_code_s["user_not_valid"] = "Su usuario no pertenece al sistema, por favor vuelva a loguarse e inténtelo de nuevo";
  $error_code_s["user_inactive"] = "Su usuario está bloqueado, por favor contacte con nosotros para solucionar esta situación";
  $error_code_s["sessionkey_expired"] = "Su llave de conexión ha cadudado";
  $error_code_s["session_expired"] = "Su sesión se ha cerrado por inactividad";

  $error_link_s["base"] = "welcome/index.html";
  $error_link_s["system_closed"] = "welcome/index.html";
  $error_link_s["db_connection_error"] = "welcome/index.html";
  $error_link_s["no_user"] = "login/index.html";
  $error_link_s["user_not_valid"] = "login/index.html";
  $error_link_s["user_inactive"] = "login/index.html";
  $error_link_s["sessionkey_expired"] = "login/index.html";
  $error_link_s["session_expired"] = "login/index.html";

?>
