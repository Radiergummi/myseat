<?php
// DB connect
$link = mysqli_connect($settings['dbHost'].':'.$settings['dbPort'], $settings['dbUser'], $settings['dbPass'], $settings['dbName']);
        mysqli_query($link, "SET NAMES 'utf8'");
        mysqli_query($link, "SET CHARACTER SET 'utf8'");
if (!$link) die('Not connected: ' . mysql_error());
?>