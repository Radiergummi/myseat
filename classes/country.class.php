<?php

function countryDropdown($default = 'DE'){
    $select = '<select name="country" id="country">' . "\n";
    foreach (Config::get('countrycodes') as $code => $name) {
		$select .= (
			$code == $default
			? '<option value="' . $code . '" selected>' . $name . '</option>' . "\n"
			: '<option value="' . $code . '">' . $name . '</option>' . "\n"
		);
	}

    $select .= '</select>';
    echo $select;
}
