<?php echo $header; ?>
<?php echo $menu; ?>

<!-- Begin dashboard/dashboard -->
<div class='onecolumn'>
 <div class='header'>
	<a href="/verwaltung/reservierungen/<?php echo buildDate($settings['dbdate'],$sd,$sm,$sj,-1); ?>" class="navgroup">
		&laquo;
	</a>
	<div class="date dategroup">
		<div class="text" id="datetext"><?php echo $_SESSION['selectedDate_user']; ?></div>
		<input type="text" id="datepicker"/>
		<input type="hidden" id="dbdate" value="<?php echo $_SESSION['selectedDate']; ?>"/>
	</div>
	<a href="/verwaltung/reservierungen/<?php echo buildDate($settings['dbdate'],$sd,$sm,$sj,1); ?>" class="navgroup">
		&raquo;
	</a>
	<!-- Begin 2nd level tab -->
	<ul class='second_level_tab'>
		<li>
			<a href='/verwaltung/dashboard' class='button_dark'> <?php echo _back;?>
			</a>
		<li/>
	</ul>
	<!-- End 2nd level tab -->
 </div>
<div id='content_wrapper'>
		<?php
			// MESSAGE boxes goes here
			include('includes/messagebox.inc.php'); 
		?>
</div>
</div>
<br class='cl' />
			<?php
			// ** print out the overview **
			// memorize actual selected outlet
			$rem_outlet = $_SESSION['outletID'];
			
			echo"<div class='onecolumn'><div class='header'>\n";
			
			switch($subtab){
				case '3':
					echo"<div class='dategroup_name'>"._dashboard." "._statistics."/"._time."</div>";	
				break;
				case '1':
					echo"<div class='dategroup_name'>"._occupancy_per_week."/"._pax."</div>";	
				break;
				case '2':
					echo"<div class='dategroup_name'>"._occupancy_per_month."/"._pax."</div>";	
				break;
			}
			?>
						<!-- Begin 2nd level tab -->
			<ul class="second_level_tab noprint">
				<li class='disabled'>
					<a href="/verwaltung/dashboard/übersicht">
						<img src='/images/icons/bars.png'/>
					</a>
				</li>
				<li>
					<a href="/verwaltung/dashboard/woche">
						<img src='/images/icons/calendar_week.png'/>
					</a>
				</li>
				<li>
					<a href="/verwaltung/dashboard/monat">
						<img src='/images/icons/calendar_month.png'/>
					</a>
				</li>
			</ul>
			<!-- End 2nd level tab -->

			</div>
<?php		
			//reset zebra containers
			$c = 0;

			// ** content of pages **
			
			switch($subtab){
				case '3':
					#include('includes/dash_sparkline.inc.php');
					echo $dashSparkline;
				break;
				case '1':
					#include('includes/dash_week.inc.php');	
					echo $dashWeek;
				break;
				case '2':
					#include('includes/dash_month.inc.php');
					echo $dashMonth;		
				break;
			}
			
			echo "</div><br class='clear' />";

			// memorize actual selected outlet
			$_SESSION['outletID'] = $rem_outlet;
			// memorize selected outlet details
			$rows = querySQL('db_outlet_info');
			if($rows){
				foreach ($rows as $key => $value) {
					$_SESSION['selOutlet'][$key] = $value;
				}
			}
			
			// ** print out all reservations **
			echo"<div class='onecolumn'><div class='header'>\n";
			echo"<div class='dategroup_name'>".$_SESSION['selectedDate_user'].", "._confirmed_reservations."</div>
			</div>\n
			<div class='content'>\n";
			
			// no waitlist
			$_SESSION['wait'] = 0;
			include('includes/reservations_grid.inc.php');
			
			echo"\n<br class='cl' /><br/>\n</div></div><br/>";
			
			?>

<br class="clear"/><br/>
<!-- End dashboard/dashboard -->
<?php echo $footer; ?>
