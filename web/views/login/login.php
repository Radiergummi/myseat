<!DOCTYPE html>
<html>
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
		<title>Login</title>

		<meta name="author" content="Moritz Friedrich"/>
		<meta name="robots" content="noindex,nofollow" />

		<link rel="stylesheet" href="/css/screen.css" type="text/css" />
		<link rel="stylesheet" href="/css/login.css" type="text/css" />

		<!--[if IE 7]>
			<link href="/css/ie7.css" rel="stylesheet" type="text/css" media="all">
		<![endif]-->

		<!--[if IE]>
			<script type="text/javascript" src="/js/excanvas.js"></script>
		<![endif]-->
	</head>
	<body class="login">
		<article class="onecolumn most-recent" id="most_recent">
			<header><h1>Verwaltung</h1></header>
			<section class="content">
				<?php if (! empty($message)): ?>
					<div id="login_info" class="alert_error" style="margin:auto;padding:auto;">
						<p>
							<img src="/images/icon_error.png" alt="success" class="middle" />
							<?php echo $message; ?>
						</p>
					</div>
				<?php endif; ?>
				<form name="loginform" id="loginform" action="/anmelden" method="post">
					<input type="text" name="user" class="user qwerty" maxlength="20" placeholder="Benutzername" value="<?php echo $username;?>" autofocus aria-label="Benutzername" />
					<input type="password" name="token" class="pass qwerty" maxlength="12" placeholder="Passwort" value="" aria-label="Passwort" />
					<div class="center">
						<input name="submit" type="submit" class="button_dark" value="Anmelden">
					<div>
				</form>
			</section>
		</article>
	</body>
</html>
