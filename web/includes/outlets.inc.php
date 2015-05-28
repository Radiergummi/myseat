  <li class="dropdown">
    <a href="#" class="dropdown-toggle"><?php echo _outlets; ?></a>
    <ul class="dropdown-menu">
		<?php
			$valid_outlets = array();
			$outlets = querySQL('db_outlets');
			foreach($outlets as $outlet) {
			 if (
				$outlet->saison_start <= $outlet->saison_end 
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
