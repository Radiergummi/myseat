<!-- Begin system/users/new -->
<div class="content">
	<div id="content_wrapper">
		<br/>
		<div class="onecolumn_wrapper">
			<div class="onecolumn small-column">
				<div class="content">
					<?php
						echo (new View('system' . DS . 'messagebox'))->render();
						echo (new View('system' . DS . 'users' . DS . 'form', ['row', $row]))->render();
						#include('includes/users_form.inc.php'); 
					?>
				</div>
			</div>
			<br class="clear" />
		</div>
	</div>
</div>
<!-- End system/users/new -->