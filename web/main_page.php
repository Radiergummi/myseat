<?php
session_start();

//Software version - http://github.com/apmuthu/myseat
$sw_version = 'v0.2160';

// define path separator ("/" for *nix, "\" for windows)
define('DS', DIRECTORY_SEPARATOR);
// path to the app's root directory
define('PATH', dirname(dirname(__FILE__)) . DS);

//######################################## hopefully soon obsolete configuration <--- really needed?
include PATH . 'config/config.general.php';

// include class loader
require PATH . 'loader.php';

// include base classes
Loader::load([
	'admin',
	'config',
	'view',
	'helper'
]);

// load configuration
Config::add(PATH . 'configuration');

// enable error reporting in development
if (Config::get('app.env') == 'development') {
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
}


// initialize user object
$user = new flexibleAccess('');

// check for logout parameter
if (isset($_GET['logout']) && $_GET['logout'] == 1) $user->logout();

// check for auth status
if (! $user->autologin()){
	// who are YOU again?
	header("Location: /anmelden");
	exit;

} else {
	$cookie = $user->read_cookie();
	$_SESSION['u_id'] = $user->userData[$user->tbFields['userID']];
	$_SESSION['u_name'] = $user->userData[$user->tbFields['login']];
	$_SESSION['u_email'] = $user->userData[$user->tbFields['email']];
	$_SESSION['role'] = $user->userData['role'];
	$_SESSION['realname'] = $user->userData['realname'];
	$_SESSION['autofill'] = $user->userData['autofill'];
	$_SESSION['property'] = $user->userData['property_id'];
	$_SESSION['propertyID'] = $user->userData['property_id'];
	$_SESSION['u_time'] = date("Y-m-d H:i:s", time());
	$_SESSION['u_lang'] = (isset($user->userData['lang_id'])) ? $user->userData['lang_id'] : '';
	$_SESSION["valid_user"] = TRUE;
}

// handle global parameters
if(isset($_POST['searchquery'])){
	Config::set('app.searchquery', $_POST['searchquery'] . '%');
	# $q = 4;
}

// include all backend classes
Loader::load([
	'connect',
	'local',
	'database',
	'business',
	'cuisines',
	'country',
	'db_queries',
	'phphooks',
	'phphooks-config'
	]);

// ** set configuration
include PATH . 'config' . DS . 'config.inc.php';

//create instance of plugin class
$plugin_path = PATH . 'plugins' . DS;
include PATH . 'config' . DS . 'plugins.init.php';

// translate to selected language
translateSite(substr($_SESSION['language'], 0, 2));

// ** get superglobal variables
include 'includes/get_variables.inc.php';


// ** content
switch ($_SESSION['page']) {
	case '1':
		$template = 'dashboard' . DS . 'dashboard';
		$templateVariables = array();
		$templatePartials = array(
			array(
				'name' => 'dashWeek',
				'template' => 'dashboard' . DS . 'dash' . DS . 'week',
				'variables' => array()
			),
			array(
				'name' => 'dashMonth',
				'template' => 'dashboard' . DS . 'dash' . DS . 'month',
				'variables' => array()
			)/*,
			array(
				'name' => 'dashStat',
				'template' => 'dashboard' . DS . 'dash' . DS . 'stat',
				'variables' => array()
			),
			array(
				'name' => 'dashSparkline',
				'template' => 'dashboard' . DS . 'dash' . DS . 'sparkline',
				'variables' => array()
			)*/
		);
	break;

	case '2':
		$_SESSION['resID'] = '';
		$template = 'reservations' . DS . 'reservations';
		$templateVariables = array(
			'dayoff' => getDayoff()
		);
		$templatePartials = array();
	break;

	case '3':
		if (current_user_can('Page-Statistic')) {
			$template = 'statistic' . DS . 'statistic';
			$templateVariables = array();
			$templatePartials = array();
		} else {
			redeclare_access();
		}
	break;

	case '4':
		if (current_user_can('Page-Export')) {
			$template = 'export' . DS . 'export';
			$templateVariables = array();
			$templatePartials = array();
		} else {
			redeclare_access();
		}
	break;

	case '5':
		redeclare_access();
	break;

	case '6':
		if (current_user_can('Page-System')) {
			$template = 'system' . DS . 'system';
			$templateVariables = array();

			$templatePartials = array(
				array(
					'name' => 'outletsGrid',
					'template' => 'system' . DS . 'outlets' . DS . 'grid',
					'variables' => array(/*'cuisines' => $cuisines*/)
				),
				array(
					'name' => 'outletsNew',
					'template' => 'system' . DS . 'outlets' . DS . 'new',
					'variables' => array()
				),
				array(
					'name' => 'usersGrid',
					'template' => 'system' . DS . 'users' . DS . 'grid',
					'variables' => array('roles' => $roles)
				),
				array(
					'name' => 'usersNew',
					'template' => 'system' . DS . 'users' . DS . 'new',
					'variables' => array('roles' => $roles)
				),
			);
		} else {
			redeclare_access();
		}
	break;

	case '101':
		if (current_user_can('Page-System')) {
			$template = 'system' . DS . 'outlets' . DS . 'detail';
			$templateVariables = array();
			$templatePartials = array(
				array(
						'name' => 'outletsDetail',
						'template' => 'system' . DS . 'outlets' . DS . 'outletsDetail',
						'variables' => array()
					)
			);
		} else {
			redeclare_access();
		}
	break;

	case '102':
		$template = 'reservation' . DS . 'detail-reservation';
		$templateVariables = array();
		$templatePartials = array();
	break;
}

$sharedVariables = array(
	// compatibility. 
	// TODO: Disable soon!
	'general' => $general, 
	'settings' => $settings,
	
	'today_date' => date('Y-m-d'),
	'subtab' => $q
);

$response = new View($template, array_merge($sharedVariables, $templateVariables));
$response->setTemplateDir(PATH . 'web' . DS . 'views');
$response->partial('header', 'partials' . DS . 'header')->partial('menu', 'partials' . DS . 'menu')->partial('footer', 'partials' . DS . 'footer');

foreach ($templatePartials as $partial) {
	$response->partial($partial['name'], $partial['template'], $partial['variables']);
}

// ** plugin hook
if ($hook->hook_exist('debug')) {
	$hook->execute_hook('debug');
}
echo $response->render();

// close database connection
mysqli_close(Config::get('db.link'));
