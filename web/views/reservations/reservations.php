<?php echo $header; ?>
<?php echo $menu; ?>
	<!-- Begin 1st level tab -->
	<ul class="first_level_tab">
		<li>
		<a href="/verwaltung/reservierungen" class="<?php echo ($subtab == 1 || $subtab == 4 ? 'active' : 'inactive'); ?>" >
				<?php 
				if ($subtab == 4){
					echo _search;	
				}else{
					echo _reservations;
				} 
				?>
			</a>
		</li>
			<?php 
			// disable "New reservation" when maitre comment is "R�cksprache"
			$findme = "R�cksprache";
			$pos = (isset($maitre['maitre_comment_day']) ? strpos($maitre['maitre_comment_day'],$findme) : false);

			if ( $today_date <= $_SESSION['selectedDate'] && $dayoff == 0 && current_user_can('Reservation-New') && $pos === false  ){
				echo'<li>
					<a href="/verwaltung/reservierungen/neu"';
					if ($subtab == 2) { echo " class='active'";}else{ echo " class='inactive'"; }
					echo' >'._add_reservation.'</a></li>';
			} 
			?>
		<?php if ($subtab != 4):?>
		<li>
			<a href="/verwaltung/reservierungen/storniert" <?php if ($subtab == 3) { echo " class='active'";}else{ echo " class='inactive'"; }?> >
				<?php echo _canceled_reservations; ?>
			</a>
		</li>
		<?php endif; ?>
	</ul>	
	<!-- End 1st level tab -->
	
	<br class="clear"/>
	
	<!-- Begin one column box -->
	<div class="onecolumn">
		
		<div class="header">
			<?php if (Config::get('app.searchquery') == ''){ ?>	
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
			<div class="dategroup_name">
				<a href="/verwaltung/reservierungen/<?php echo $_SESSION['selectedDate']; ?>">
					<?php 
					echo $_SESSION['selOutlet']['outlet_name'] . " - " . strftime("%A", strtotime($_SESSION['selectedDate'])) . ", " . $_SESSION['selectedDate_user']; 
					?>
				</a>
			</div>
			<!-- Begin 2nd level tab -->
			<ul class="second_level_tab noprint">
				<li>
					<a href="#" id="outlet_detail_button">
						<?php echo _detail;?>
					</a>
				</li>
				<li>
					<a id="cxlbuttontrigger" href="/ajax/cxllist.php">CXL</a>
				</li>
				<?php if ($subtab == 1){ ?>
				<li>
					<a href="javascript:window.print()">
						<!-- <img src="/images/menu-icons/printer.png" alt="Print"> -->
						<?php echo _print;?>
					</a>
				</li>
				<?php } ?>
			</ul>
			<!-- End 2nd level tab -->
			<?php }else{ ?>
			<div class="dategroup_name">
				<?php echo _search_results;?>
			</div>
			<!-- Begin 2nd level tab -->
			<ul class="second_level_tab">
				<li>
					<a href="/verwaltung/reservierungen" id="search_back_button">
						<?php echo _back;?>
					</a>
				</li>
			</ul>
			<!-- End 2nd level tab -->
			<?php } ?>
		</div>

		<!-- Daily outlets details -->
		<div id='daily_outlets_details'>
			<?php include('includes/daily_outlet_details.inc.php'); ?>
		</div>		

		<!-- ALERT & MESSAGE boxes goes here -->
			<?php
			if(Config::get('app.searchquery') == '' && $_SESSION['storno'] == 0){
				echo "<div class='noprint'>"; 
					include('includes/messagebox.inc.php'); 
				echo "</div>";
			} 
			$_SESSION['errors'] = array();
			$_SESSION['messages'] = array();
			?>

		<!-- CAPACITY timeline goes here -->
		<?php

		if(($subtab=='1' || $subtab=='2') && $dayoff == 0){
		echo "<div class='timeline-section' id='timeline'>";	
			include('includes/timeline.inc.php');
		echo "</div><br class='clear'/>";	
		}
		?>
		
		<!-- Begin nomargin -->
		<div class="content">
			
			<?php
			// ** content
			switch($subtab){
				case '1':
				 if($dayoff == 0){	
					// confirmed
					echo "<br/><h3>"._confirmed_reservations."</h3>";
					include('includes/reservations_grid.inc.php');
		
					// waitlist
					$_SESSION['wait'] = 1;
					$waitlist =	querySQL('reservations');
					if($waitlist){
						echo "<br/><br/><h3>"._wait_list."</h3>";
						include('includes/reservations_grid.inc.php');
					}
				 }else{
					echo "<h2 class='dayoff'>"._day_off."</h2>";
				 }
				break;
				case '2':
					// new
					include('includes/new.inc.php');
				break;
				case '3':
					// cancelled/storno
					include('includes/reservations_grid.inc.php');
				break;
				case '4':
					// search
					include('includes/search_grid.inc.php');
				break;
			}
			echo"<br/>";
			include('includes/manual_lines.inc.php');
			//most recent reservations
			include('includes/recent.inc.php');
			?>
			<br/>
			<br class="clear"/>
		</div>
		<!-- End nomargin -->
</div>
<br class="clear"/>

<?php 

echo $footer;
?>
