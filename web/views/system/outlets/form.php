	<?php
$outlets = querySQL('outlet_info');
foreach ($outlets as $outlet) {?>
<div class="content form-height">
<form method="post" action="/web/main_page.php?p=6" id="edit_outlet_form">
	<label><?php echo _property;?></label>
	<p><span class='bold'>	 	 				 
		<?php echo querySQL('db_property');?>
	</strong></p>
	<label><?php echo _name;?></label>
	<p>
		<input type="text" name="outlet_name" id="outlet_name" class="required" value="<?php echo $outlet->outlet_name;?>"title=' '/>
	</p>
	<label><?php echo _cuisine_style;?></label>
	<p>
  		<?php echo cuisineDropdown($cuisines,$outlet->cuisine_style);?>
	</p>
	<br/>
	<label><?php echo _description;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_1;?>"/>
	<p>
		<textarea name="outlet_description" id="outlet_description" rows="5" cols="35" class="required width-97" title=' '><?php echo trim($outlet->outlet_description);?></textarea>
	</p>
	<br/>
	<label><?php echo _description." "._international;?></label>
	<p>
		<textarea name="outlet_description_en" id="outlet_description_en" rows="5" cols="35" class="required width-97" title=' '><?php echo trim($outlet->outlet_description_en);?></textarea>
	</p>	
	<label><?php echo _confirmation_email;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_2;?>"/>
	<p>
		<input type="text" name="confirmation_email" id="confirmation_email" class="required email" title=' ' value="<?php echo $outlet->confirmation_email;?>"/>
	</p>
	<label><?php echo _seats;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_3;?>"/>
	<p>		 	 	 	 	 	 	
		<input type="text" name="outlet_max_capacity" id="outlet_max_capacity" class="required digits" title=' ' value="<?php echo $outlet->outlet_max_capacity;?>"/>
	</p>
	<label><?php echo _tables;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_4;?>"/>	
	<p>	 	 	 	 	 	 	
		<input type="text" name="outlet_max_tables" id="outlet_max_tables" class="required digits" title=' ' value="<?php echo $outlet->outlet_max_tables;?>"/>
	</p>
	<label><?php echo _passerby;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_5;?>"/>	
	<p>	 	 	 	 	 	 	
		<input type="text" name="passerby_max_pax" id="passerby_max_pax" class="digits" title=' ' value="<?php echo $outlet->passerby_max_pax;?>"/>
	</p>
	<label><?php echo _duration;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_6;?>"/>	
	<p>	 	 	 	 	 	 			
			<?php getDurationList(Config::get('general.timeintervall'),'avg_duration',$outlet->avg_duration);?>
	</p>
	<label><?php echo _password;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_7;?>"/>	
	<p>	 	 	 	 	 	 	
		<input type="text" name="limit_password" id="limit_password" title=' ' value="<?php echo $outlet->limit_password;?>"/>
	</p>
	<label><?php echo _webform;?></label>
	&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_8;?>"/>
	<p>		
		<?php echo printOnOff($outlet->webform,'webform','');?>
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
				// buildDate($general['dateformat_short'],substr($outlet->saison_start,2,2),substr($outlet->saison_start,0,2));
				echo monthDropdown('saison_start_month',substr($outlet->saison_start,0,2));
				echo " "; 
				echo dayDropdown('saison_start_day',substr($outlet->saison_start,2,2));
				?>
			</p>			 	 	 	 	 	 	 
			<label><?php echo _season_end;?></label>	
			<p>		
				<?php
				// buildDate($general['dateformat_short'],substr($outlet->saison_end,2,2),substr($outlet->saison_end,0,2));
				echo monthDropdown('saison_end_month',substr($outlet->saison_end,0,2));
				echo " ";
				echo dayDropdown('saison_end_day',substr($outlet->saison_end,2,2));
				?>
			</p>
			<label><?php echo _year;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_10;?>"/>
			<p>
					<?php echo yearDropdown('saison_year',$outlet->saison_year); ?>
			</p>
			<br/>
			<label><?php echo _day_off;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_11;?>"/>
			<p>	
				<?php echo getWeekdays_select($outlet->outlet_closeday); ?>	
			</p>
			<br/>
			<label><?php echo _general." "._open_time." & "._close_time;?></label>
			&nbsp;<img src="/images/icons/infos.png" class="tipsyold" title="<?php echo MAN_12;?>"/>
			<p>		 	 	 	 	 	 	
				<?php 
					getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), 'outlet_open_time',$outlet->outlet_open_time);
				   	echo " ";
	 	 	 	   	getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), 'outlet_close_time',$outlet->outlet_close_time);
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
						getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), $field_open,$outlet->$field_open);
						echo " ";
						getTimeList(Config::get('general.timeformat'), Config::get('general.timeintervall'), $field_close,$outlet->$field_close);
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
						getTimeList($general['timeformat'], $general['timeintervall'],$field_open,$outlet->$field_open);
						echo " ";
						getTimeList($general['timeformat'], $general['timeintervall'],$field_close,$outlet->$field_close);
						echo "<br/></td></tr>";
						$day = $day + 86400;
					}
 	 	 	 	 ?>	
				</table>
			</p>	 	 	 	 	 	 	 	 	 	 	 	 	 	 		 	 	 	 	 	 	 	
			<br/><br/>
			<?php if ($_SESSION['button']!=2): ?> 	 	 	 	 	 	 
				<small>				
					<?php echo _created." ".humanize($outlet->outlet_timestamp);?>
				</small>
			<?php endif ?>	
			<input type="hidden" name="outlet_id" value="<?php echo $outlet->outlet_id;?>">
			<input type="hidden" name="property_id" value="<?php echo $_SESSION['property'];?>">
			<input type="hidden" name="token" value="<?php echo Config::get('user.token'); ?>" />
			<input type="hidden" name="action" value="save_out">
</form>
</div>
<?php } ?>