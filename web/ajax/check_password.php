<?php 
require 'init.php';

Loader::load([
	'connect',
	'database',
	'local',
	'db_queries',
]);

// set configuration
include PATH . 'config/config.general.php';

// ** set configuration
include(PATH . 'config/config.inc.php');

session_start();

$_SESSION['language'] = ($_SESSION['language'] ? $_SESSION['language'] : 'de');

// translate to selected language
translateSite(substr($_SESSION['language'], 0, 2), PATH . 'web' . DS);

// prevent dangerous input
secureSuperGlobals();

if(isSet($_POST['password'])){
	
    if($_POST['password'] != $_SESSION['selOutlet']['limit_password']){
        echo '&nbsp;<span style="color: red;">'. _wrong_password .'</span>';
    }else{
        echo "OK";
    }

}
