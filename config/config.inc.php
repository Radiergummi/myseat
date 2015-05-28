<?php
// Get global file path
function GetFileDir($php_self){
	$filename2 = '';
	$filename = explode("/", $php_self);
		for( $i = 0; $i < (count($filename) - 2); ++$i ) {
			$filename2 .= $filename[$i].'/';
		}
	return $filename2;
}

// General settings per resort from database
$general = array();
Config::set('general', querySQL('settings_inc'));
$general = Config::get('general');

if (Config::get('general')) {
	if($_SESSION['valid_user']) {
		$_SESSION['language'] = Config::get('general.language');
	}

	// Set default timezone
	if (function_exists('date_default_timezone_set')) {
		date_default_timezone_set(Config::get('general.timezone'));
	}

	/* Set PHP local */
	setlocale(LC_TIME, Config::get('general.language'));
}
?>

