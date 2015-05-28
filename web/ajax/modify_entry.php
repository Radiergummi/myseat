<?php
require 'init.php';

Loader::load([
	'connect',
	'database',
	'db_queries',
	'phphooks',
	'phphooks-config'
]);

// set configuration
include PATH . 'config/config.general.php';

//create instance of plugin class
$plugin_path = PATH . 'plugins' . DS;
include PATH . 'config' . DS . 'plugins.init.php';

// prevent dangerous input
secureSuperGlobals();

if (isset($_GET['action'])) {
	$action = $_GET['action'];
} else if (isset($_POST['action'])) {
	$action = $_POST['action'];
}

if (isset($_GET['author'])) {
	$author = $_GET['author'];
} else if (isset($_POST['author'])) {
	$author = $_POST['author'];
}

if (isset($_GET['cellid'])) {
	$cellid = $_GET['cellid'];
} else if (isset($_POST['cellid'])) {
	$cellid = $_POST['cellid'];
}

$repeatid=0;
if (isset($_GET['repeatid'])) {
	$repeatid = $_GET['repeatid'];
} else if (isset($_POST['repeatid'])) {
	$repeatid = $_POST['repeatid'];
}

if (isset($_GET['button'])) {
	$button = $_GET['button'];
} else if (isset($_POST['button'])) {
	$button = $_POST['button'];
}


if ($action=="DEL") {
	if ($button == 'all') {
		// ****** DELETE MULTI ******
		$cmd_delete = querySQL('del_res_multi');
		// ** plugin hook
		if ($hook->hook_exist('after_del_res')) {
			$hook->execute_hook('after_del_res');
		}
		$reservation_id=0;

		return $cmd_delete;
	} else if ($button == 'single') {	
		// ****** DELETE SINGLE ******
		$cmd_delete = querySQL('del_res_single');
		// ** plugin hook
		if ($hook->hook_exist('after_del_res')) {
			$hook->execute_hook('after_del_res');
		}

		return $cmd_delete;
	}
} else if ($action == "ALW") {	
	// ****** ALLOW SINGLE ******
	$cmd_allow = querySQL('alw_res_single');
	// ** plugin hook
	if ($hook->hook_exist('after_alw_res')) {
		$hook->execute_hook('after_alw_res');
	}

	return $cmd_allow;
}
?>