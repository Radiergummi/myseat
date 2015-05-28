<header class="topbar clearfix" id="topbar">
	<div class="currentuser">
		<?php
		if (!isset($_SESSION['prp_name'])) {
			$_SESSION['prp_name'] = querySQL('db_property');
		}
		
		$filename = substr(dirname(__FILE__),0,-9)."xt-admin";
		
		if((!isset($this_page)) || ($this_page != "property")) {
			echo "<img src='/images/icon_user.png' alt='User:' /><a href='";
			if ($_SESSION['role']=='1' && file_exists($filename)) {
				echo"../xt-admin/index.php";				
			}
			$name = ($_SESSION['realname']=='') ? $_SESSION['u_name'] : $_SESSION['realname'];
			echo "'><span class='name'> ".$name."</span></a>";
		}
		?>			
	</div>
	<a href="/abmelden" title="Logout" class="logout">Abmelden</a>
	<div class="container">
		<nav>
			<ul class="nav">
				<li>
					<a class="brand" href="/verwaltung">
						<img src="/images/logo.png" alt="" />
					</a>
				</li>
				<li class="dropdown">
					<a href="#" class="dropdown-toggle"><?php echo _outlets; ?></a>
					<ul class="dropdown-menu">
						<?php
							$valid_outlets = array();
							$outlets = querySQL('db_outlets');

							foreach($outlets as $outlet) {
							 if ( $outlet->saison_start <= $outlet->saison_end 
							 && $_SESSION['selectedDate_saison'] >= $outlet->saison_start 
							 && $_SESSION['selectedDate_saison'] <= $outlet->saison_end
								) {
								echo"<li>\n<a href='/verwaltung/reservierungen/" . $outlet->outlet_id . "'>" . $outlet->outlet_name . "</a>\n</li>\n";
								$valid_outlets[] = $outlet->outlet_id;
								}
							}
						?>
					</ul>
				</li>
				<li>
					<a href="/verwaltung/dashboard" <?php if ($_SESSION['page']=='1') { echo "class='active'"; } ?> >
						<?php echo _dashboard; ?>	
					</a>
				</li>
				<?php if (current_user_can('Page-Statistic')): ?>
				<li>
					<a href="/verwaltung/statistiken" <?php if ($_SESSION['page']=='3') { echo "class='active'"; } ?> >
						<?php echo _statistics; ?>
					</a>
				</li>
				<?php endif ?>
				<?php if (current_user_can('Page-Export')): ?>
				<li>
					<a href="/verwaltung/export" <?php if ($_SESSION['page']=='4') { echo "class='active'"; } ?> >
						<?php echo _export; ?>
					</a>
				</li>
				<?php endif ?>
				<?php if (current_user_can('Page-System')): ?>
				<li>
					<a href="/verwaltung/einstellungen" <?php if ($_SESSION['page']=='6') { echo "class='active'"; } ?> >
						<?php echo _system; ?>
					</a>
				</li>
				<?php endif ?>
				<li>
					<form action="/verwaltung/reservierungen" id="search_form" name="search_form" method="post">
						<input type="text" id="searchquery" name="searchquery" title="<?php echo _search_guest; ?>"/>
						<input type="hidden" name="action" value="search">
					</form>
				</li>
			</ul>
		</nav>
	</div>
   </header>
<div id="wrapper" class="clearfix">