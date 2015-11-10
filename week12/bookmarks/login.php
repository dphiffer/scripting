<?php

require_once 'setup.php';

?>
<form action="login.php" method="post">
    <input type="text" name="username">
    <input type="password" name="password">
    <input type="submit" value="Login">
</form>
<?php


$logged_in = false;
if (!empty($_POST['username']) &&
    !empty($_POST['password'])) {
	login_user();
}

if (check_login()) {
	echo 'You are logged in.';
}
    
?>
