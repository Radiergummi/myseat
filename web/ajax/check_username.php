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

if(isset($_POST['username'])){
    $value = $_POST['username'];

    $sql_check = querySQL('check_username');

    if(mysqli_num_rows($sql_check)){
        echo '<span style="color: red;">' . _already_user_1 . ' <span class="bold">' . $value . '</span> ' . _already_user_2 . '</span>';
    }else{
        echo "OK";
    }
}
