<?php
require 'init.php';

Loader::load([
	'connect',
	'database',
	'local',
	'business',
	'db_queries',
]);

// set configuration
include PATH . 'config/config.general.php';

// ** set configuration
include(PATH . 'config/config.inc.php');

session_start();

// translate to selected language
translateSite(substr($_SESSION['language'], 0, 2), PATH . 'web' . DS);

// check for new reservations
$new = querySQL('cxl_list');

if($new!=''){
	$i = 1;
	$message = "<div style='width:400px; padding-left:23px;'>";
	$message .= "<h2>CXL " . _overview . "</h2>";
	$message .= "<p>" . _cxl_text . "</p><br />";
	foreach ($new as $row) {
		$message .= $i . ". " .printTitle($row->reservation_title) . " <strong>" . $row->reservation_guest_name . "</strong> " . _canceled_ . " " . $row->count . "x<br/><br/>";
		$i++;
	}
	$message .= "</div>";
	echo $message;
}
