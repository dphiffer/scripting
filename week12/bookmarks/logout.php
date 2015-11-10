<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}
$_SESSION['username'] = null;
session_destroy();
echo "You are logged out.";

?>
