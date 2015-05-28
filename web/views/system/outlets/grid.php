<!-- Begin system/outlets/grid -->
<table class="global width-100" cellpadding="0" cellspacing="0">
	<thead>
	    <tr>
			<th>ID</th>
			<th><?php echo _name; ?></th>
			<th><?php echo _seats; ?></th>
			<th><?php echo _tables; ?></th>
			<th><?php echo _open_time; ?></th>
			<th><?php echo _duration; ?></th>
			<th><?php echo _season_start; ?></th>
			<th><?php echo _year; ?></th>
			<th><?php echo _cuisine_style; ?></th>
	    	<th><?php echo _webform; ?></th>
			<th><?php echo _delete; ?></th>
	    </tr>
	</thead>
	<tbody>
		<?php
			if($_SESSION['button'] == 1){
				$outlets =	querySQL('db_all_outlets');
			}else if($_SESSION['button'] == 3){
				$outlets =	querySQL('db_all_outlets_old');
			}
		
		if ($outlets) {
			foreach($outlets as $outlet) {
			$pr_year = ($outlet->saison_year==0) ? '&nbsp;' : $outlet->saison_year;
			
			echo "<tr id='outlet-".$outlet->outlet_id."'>";
			echo "<td>".$outlet->outlet_id."</td>
			<td>
				<span class='bold'>
					<a href='/verwaltung/einstellungen/outlets/".$outlet->outlet_id."'>".$outlet->outlet_name."</a>
				</strong>
			</td>
			<td><span class='bold'>".$outlet->outlet_max_capacity."</strong></td>
			<td><span class='bold'>".$outlet->outlet_max_tables."</strong></td>
			<td>".formatTime($outlet->outlet_open_time,Config::get('general.timeformat'))." - ".
			formatTime($outlet->outlet_close_time,Config::get('general.timeformat'))."</td>
			<td>".$outlet->avg_duration."</td>
			<td>".buildDate(Config::get('general.dateformat_short'),substr($outlet->saison_start,2,2),substr($outlet->saison_start,0,2))." - ".
			buildDate(Config::get('general.dateformat_short'),substr($outlet->saison_end,2,2),substr($outlet->saison_end,0,2))."</td>
			<td>".$pr_year."</td>
			<td><small>" . Config::get('cuisines')[($outlet->cuisine_style-1)] . "</small></td>
			<td>".printOnOff($outlet->webform)."</td>
		    <td>
					<a href='#modaldelete' name='outlets' id='".$outlet->outlet_id."' class='deletebtn'>
					<img src='/images/icons/delete_cross.png' alt='"._cancelled."' class='help' title='"._delete."'/>
					</a>
		    	</td>
			</tr>";
			}
		}
		?>
	</tbody>
</table>
<!-- End system/outlets/grid -->