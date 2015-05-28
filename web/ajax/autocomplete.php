<?php
/*
**************************************************************************
                  AutoSuggest build a database query
**************************************************************************/
include_once('../../config/config.general.php');

$return_arr = array();
	
mysqli_connect($settings['dbHost'], $settings['dbUser'], $settings['dbPass'], $settings['dbName']);
mysqli_query("SET NAMES 'utf8'");

$field = $_GET['field'];
$term = $_GET['term'];

// prevent SQL injection 
if ($field == 'reservation_guest_name' || $field == 'reservation_booker_name' ) {
	
	$sql = "SELECT DISTINCT ".$field." FROM $dbTables->reservations WHERE ".$field." LIKE '".$term."%' ORDER BY ".$field." ASC ";
	$fetch = mysqli_query($sql);
		/* Retrieve and store in array the results of the query.*/
	if($fetch){
		while ($row = mysqli_fetch_array($fetch, MYSQL_ASSOC)) {
			$row_array['value'] = $row[$field];

	        array_push($return_arr,$row_array);
	    }

	}

	/* Free connection resources. */
	mysqli_close();

	/* Toss back results as json encoded array. */
	echo json_encode($return_arr);
}
?>