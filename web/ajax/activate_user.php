<?php
require 'init.php';

Loader::load([
	'connect',
	'database',
	'db_queries',
]);

// set configuration
include PATH . 'config/config.general.php';

if($_POST['cellid']){
	// prevent dangerous input
	secureSuperGlobals();
	
	$value = ($_POST['action']=='enable') ? '1' : '0';
	$id = (int)$_POST['cellid'];
	
	if (isset($id) ) {
		$sql = querySQL('user_activate');
		echo $sql;
	}else{
		echo "AJAX Error";
	}
}
