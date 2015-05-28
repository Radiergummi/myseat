<?php
require 'init.php';

Loader::load([
	'connect',
	'database',
	'db_queries',
]);

// set configuration
include PATH . 'config/config.general.php';

if($_POST['id']) {
	// prevent dangerous input
	secureSuperGlobals();
	
	/* Get POST data */        
	$submitted_id = $_POST['id'];
	$value = $_POST['value'];
	$exid = explode("-",$submitted_id); 
	$field = $exid[0];
	$id = $exid[1];
	
	/* Submit POST data */  
	$sql = querySQL('inline_edit');

	/* Submit POST data */  
	echo $value;
}
