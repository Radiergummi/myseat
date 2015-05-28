<?php
function cuisineDropdown($selected=1) {
	// Set standard
	if ($selected==0 || $selected=='') {
		$selected=50;
	}
	
	echo "<select name='cuisine_style' id='cuisine_style' size='1'>\n";
	// loooping...
	foreach (Config::get('cuisines') as $key => $value) {
		echo "<option value='".($key+1)."' ";
		echo ($selected==$key+1) ? "selected='selected'" : "";
		echo ">".$value."</option>\n";
	}		
	
	echo "</select>\n";
}