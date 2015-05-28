<!-- Begin system/outlets/new -->
<div class="content">
  <div id="content_wrapper">
	<div class="twocolumn_wrapper">
	 <div class="twocolumn">

	 	<?php
		 	// include messagebox template
		 	echo (new View('system' . DS . 'messagebox'))->render();
		?>
		<div class="content form-height">
		<form method="post" action="/verwaltung/einstellungen/outlets" id="edit_outlet_form">
			<label><?php echo _property;?></label>
			<p><span class='bold'>	 	 				 
				<?php echo querySQL('db_property');?>
			</strong></p>
			<label><?php echo _name;?></label>
			<p>
				<input type="text" name="outlet_name" id="outlet_name" class="required" value=""title=' '/>
			</p>
			<label><?php echo _cuisine_style;?></label>
			<p>
				<?php echo cuisineDropdown();?>
			</p>
			<br/>
			<label><?php echo _description;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_1;?>"/>
			<p>
				<textarea name="outlet_description" id="outlet_description" rows="5" cols="35" class="required width-97" title=' '></textarea>
			</p>
			<br/>
			<label><?php echo _description." "._international;?></label>
			<p>
				<textarea name="outlet_description_en" id="outlet_description_en" rows="5" cols="35" class="required width-97" title=' '></textarea>
			</p>	
			<label><?php echo _confirmation_email;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_2;?>"/>
			<p>
				<input type="text" name="confirmation_email" id="confirmation_email" class="required email" title=' ' value=""/>
			</p>
			<label><?php echo _seats;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_3;?>"/>
			<p>		 	 	 	 	 	 	
				<input type="text" name="outlet_max_capacity" id="outlet_max_capacity" class="required digits" title=' ' value=""/>
			</p>
			<label><?php echo _tables;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_4;?>"/>	
			<p>	 	 	 	 	 	 	
				<input type="text" name="outlet_max_tables" id="outlet_max_tables" class="required digits" title=' ' value=""/>
			</p>
			<label><?php echo _passerby;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_5;?>"/>	
			<p>	 	 	 	 	 	 	
				<input type="text" name="passerby_max_pax" id="passerby_max_pax" class="digits" title=' ' value=""/>
			</p>
			<label><?php echo _duration;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_6;?>"/>	
			<p>	 	 	 	 	 	 			
					<?php getDurationList(Config::get('general.timeintervall'),'avg_duration');?>
			</p>
			<label><?php echo _password;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_7;?>"/>	
			<p>	 	 	 	 	 	 	
				<input type="text" name="limit_password" id="limit_password" title=' ' value=""/>
			</p>
			<label><?php echo _webform;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_8;?>"/>
			<p>		
				<?php echo printOnOff('','webform','');?>
			</p>
			<br/><br/>		 	 	 	 	 	 		 	 	 	 	 	 				 	 	 	 	 	 	 
			<br class="clear">
				<input type="submit" class="button_dark" value="<?php echo _save;?>"/>		 	 	 	 	 	 	 			 	 	 	 	 	 	
		</div></div></div> <!-- end left column -->
		<!-- Beginn right column -->	
		<div class="twocolumn_wrapper right">
			<div class="twocolumn" >
				<div class="content form-height">
					<label><?php echo _season_start;?></label>
					&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_9;?>"/>
					<p>		
						<?php
						echo monthDropdown('saison_start_month');
						echo " "; 
						echo dayDropdown('saison_start_day');
						?>
					</p>			 	 	 	 	 	 	 
					<label><?php echo _season_end;?></label>	
					<p>		
						<?php
						echo monthDropdown('saison_end_month');
						echo " ";
						echo dayDropdown('saison_end_day');
						?>
					</p>
					<label><?php echo _year;?></label>
					&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_10;?>"/>
					<p>
							<?php echo yearDropdown('saison_year'); ?>
					</p>
					<br/>
					<label><?php echo _day_off;?></label>
					&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_11;?>"/>
					<p>	
						<?php echo getWeekdays_select(''); ?>	
					</p>
					<br/>
					<label><?php echo _general." "._open_time." & "._close_time;?></label>
					&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_12;?>"/>
					<p>		 	 	 	 	 	 	
						<?php 
							getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), 'outlet_open_time', '');
							echo " ";
							getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), 'outlet_close_time', '');
						?>
					</p>
					<br/>
					<label><?php echo _specific." "._open_time." & "._close_time;?></label>
					&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_13;?>"/>
					<p>	
						<table class='opentime-table'>
						 <?php
							$day = strtotime("next Monday");
							for ($i=1; $i <= 7; $i++) { 
								$weekday = date("w",$day);
								$field_open = $weekday.'_open_time';
								$field_close = $weekday.'_close_time';
								echo "<tr><td>".date("l",$day)."&nbsp;</td><td>";
								getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), $field_open, '');
								echo " ";
								getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), $field_close, '');
								echo "<br/></td></tr>";
								$day = $day + 86400;
							}
						 ?>	
						</table>
					</p>
					<br/>
					<label><?php echo _break;?></label>
					&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_14;?>"/>
					<p>	
						<table class='opentime-table'>
						 <?php
							$day = strtotime("next Monday");
							for ($i=1; $i <= 7; $i++) { 
								$weekday = date("w",$day);
								$field_open = $weekday.'_open_break';
								$field_close = $weekday.'_close_break';
								echo "<tr><td>".date("l",$day)."&nbsp;</td><td>";
								getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), $field_open,'');
								echo " ";
								getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), $field_close, '');
								echo "<br/></td></tr>";
								$day = $day + 86400;
							}
						 ?>	
						</table>
					</p>	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	

					<input type="hidden" name="outlet_id" value="">
					<input type="hidden" name="property_id" value="<?php echo $_SESSION['property'];?>">
					<input type="hidden" name="token" value="<?php echo Config::get('user.token'); ?>" />
					<input type="hidden" name="action" value="save_out">
		</form>
		</div>	
	 </div>
	</div>
		<br class="clear" />
  </div>
</div>
<!-- End system/outlets/new -->