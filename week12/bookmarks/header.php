<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Bookmarks!</title>
	</head>
	<body>
		<?php
		
		$logged_in = check_login();
		if ($logged_in) {
			echo '<a href="logout.php">Logout</a>';
		} else {
			echo '<a href="login.php">Login</a>';
		}
		
		?>
