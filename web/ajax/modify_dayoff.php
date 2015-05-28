<?php
require 'init.php';

Loader::load([
	'connect',
	'database',
	'db_queries',
]);

// set configuration
include PATH . 'config/config.general.php';

session_start();

	// prevent dangerous input
	secureSuperGlobals();
	
	$value = $_POST['value'];
	$id	   = $_POST['id'];
	
	$sql = querySQL('update_maitre_dayoff');
	
	echo $sql;
?>