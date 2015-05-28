<?php
require 'init.php';

Loader::load([
	'connect',
	'database',
	'db_queries'
]);

// set configuration
include PATH . 'config/config.general.php';

if($_POST['id']){
	// prevent dangerous input
	secureSuperGlobals();
	
	$value = $_POST['value'];
	$id = (int)$_POST['id'];
	
	if ($select_id !='undefinded') {
		$sql = querySQL('update_status');
		echo $sql;
	}else{
		echo "AJAX Error";
	}
}
