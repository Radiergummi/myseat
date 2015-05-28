<?php

session_start();

define('DS', DIRECTORY_SEPARATOR);
define('PATH', dirname(dirname(__FILE__)) . DS);

require PATH . 'loader.php';

Loader::load(['config', 'admin', 'view']);
Config::add(PATH . 'configuration');



// ** clear all old session variables
$_SESSION = array();
$username = "";

// ** Set redirect page
$forwardPage = Config::get('management.url');

//####################################### ** set configuration <-- really needed here?
include('../config/config.general.php');

$user = new flexibleAccess();
	
// ** auto checkout when going to loginpage
$user->logout();

// ** User LOGIN **
if(isset($_POST['submit'])){

// ** init variables
$validate = true;
$username = $_POST['user'];

// ** Validate username and password
if(strlen($username) < 4) {
	$message = "Username is required.";
	$validate = false;
	
} else if (strlen($_POST['token']) < 4) {
	$message = "Password is required.";
	$validate = false;
}

// ** Check if user wants to change the password
$newpassword = "";
if ( isset($_POST['nPass1']) && isset($_POST['nPass2']) ) {
	if ( $_POST['nPass1'] == $_POST['nPass2'] ) {
		$newpassword = substr($_POST['nPass1'],0,12);

	} else {
		$user->login_matchFalse();	
		exit; //To ensure security
	}
}

	// ** User LOGIN process if $validate is true
	if($validate){
		$loginAttempt = $user->login(
			substr($_POST['user'],0,30),
			substr($_POST['token'],0,12),
			$newpassword
		);
 
    if ( $loginAttempt == 1 ){
			$message = "Login Success.";
			header("Location: ".$forwardPage);
			exit; //To ensure security

    } else if ( $loginAttempt == 0 ){
			$l = 1 + $user->loginAttempts - $user->fAtmp;
			$message = "Fehler: Die angegebenen Daten sind nicht korrekt. Noch ".$l." Versuche.";

		} else if ( $loginAttempt == 2 ){
			$message = "Anmeldung für ".$user->loginTime." Minuten blockiert: Zu viele fehlgeschlagene Anmeldeversuche.";
			$username = "";

    } else if ( $loginAttempt == 3 ){
			$message = "Das Passwort wurde erfolgreich geändert.";
			$username = "";

		} else if ( $loginAttempt == 4 ){
			$message = "Password unsave! It's not allowed.";

		} else {
			$message = "";
			$username = "";
		}
	}
} else {
	$message = "";
}

/**
 * Create login view
 *
 */
$response = new View('login' . DS . 'login', ['message' => $message, 'username' => $username]);

// set template directory
View::setTemplateDir(PATH . 'web' . DS . 'views' . DS);

// render response
echo $response->render();
