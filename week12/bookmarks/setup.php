<?php

$username = 'bookmarks';
$password = 'kdN3l1.491';
$dsn = 'mysql:host=127.0.0.1;dbname=bookmarks';
$db  = new PDO($dsn, $username, $password);

function get_valid_accounts() {
	global $db;
	$query = $db->query("
	    SELECT *
	    FROM accounts
	");
	$valid_accounts = array();
	foreach ($query->fetchAll() as $account) {
		$username = $account['username'];
		$password = $account['password'];
		$valid_accounts[$username] = $password;
	}
	return $valid_accounts;
}

function check_login() {
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}
	return (!empty($_SESSION['username']));
}

function login_user() {
	$valid_accounts = get_valid_accounts();
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	if (!empty($valid_accounts[$username]) &&
	    $valid_accounts[$username] == $password) {
		$logged_in = true;
		if (session_status() == PHP_SESSION_NONE) {
			session_start();
		}
		$_SESSION['username'] = $username;
	}
}

?>
