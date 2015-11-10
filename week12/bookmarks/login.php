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
	$password = md5($_POST['password']);
	print_r($valid_users);
	print_r($_POST);
	if (!empty($valid_users[$username]) &&
	    $valid_users[$username] == $password) {
		$logged_in = true;
		echo "You are logged in.";
	}
}
    
?>
