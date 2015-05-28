<?php
echo "<div class='center width-70'><br/>";

	echo "<!-- Begin OutletList -->";
	outletList($_SESSION['outletID'],'enabled','reservation_outlet_id','ON');
	echo "<!-- End OutletList -->";
	
    $dateComponents = getdate();
	list($sy,$sm,$sd) = explode("-",$_SESSION['selectedDate']);
	if(!isset($dateArray)) $dateArray = false;
    echo build_calendar($sm,$sy,$dateArray);

echo"</div><br/>";
?>