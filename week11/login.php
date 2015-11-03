<?php

error_reporting(E_ALL);
ini_set('display_errors', true);

$logged_in = check_login();

function check_login() {
	$valid_accounts = array(
		'foo' => 'n0tf00'
	);
	if (!empty($_POST['username']) &&
	    !empty($_POST['password'])) {
		$username = $_POST['username'];
		$password = $_POST['password'];
		if (!empty($valid_accounts[$username]) &&
		    $valid_accounts[$username] == $password) {
			log_auth("User $username successfully logged in.");
			return true;
		}
		log_auth("User $username attempted to log in and failed.");
	}
	return false;
}

function log_auth($message) {
	global $_fh_auth_log;
	if (empty($_fh_auth_log)) {
		$_fh_auth_log = fopen('login.log', 'a');
	}
	fwrite($_fh_auth_log, "$message\n");
}

?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Login demo</title>
	</head>
	<body>
		<form action="login.php" method="post">
			<input type="text" name="username">
			<input type="password" name="password">
			<input type="submit" value="Login">
		</form>
		<?php
		
		if ($logged_in) {
			echo "You are logged in.";
		} else {
			echo "You are *not* logged in.";
		}
		
		?>
	</body>
</html>
