<?php
session_start();
$_SESSION = array();
$_SESSION['forwardPage'] = "../web/main_page.php?p=1";
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta http-equiv="refresh" content="0;url= ../admin/index.php" />
	</head>
	<body>
	</body>
</html>
