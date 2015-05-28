<?php
	
// DB connect
Config::set(
	'db.link',
	mysqli_connect(
		Config::get('db.host') . ':' . Config::get('db.port'),
		Config::get('db.user'),
		Config::get('db.password'),
		Config::get('db.name')
	)
);

mysqli_query(Config::get('db.link'), "SET NAMES 'utf8'");
mysqli_query(Config::get('db.link'), "SET CHARACTER SET 'utf8'");

if (! Config::get('db.link')) die('Not connected: ' . mysqli_error());