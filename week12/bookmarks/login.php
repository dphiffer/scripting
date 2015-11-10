<form action="login.php" method="post">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="Login">
</form>
<?php

$logged_in = false;
if (!empty($_POST['username']) &&
    !empty($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];
	if (!empty($valid_users[$username]) &&
	    $valid_users[$username] == $password) {
		$logged_in = true;
	}
}
    
?>
