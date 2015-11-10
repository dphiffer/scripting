<?php

$username = 'bookmarks';
$password = 'kdN3l1.491';
$dsn = 'mysql:host=127.0.0.1;dbname=bookmarks';
$db  = new PDO($dsn, $username, $password);
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

function check_login() {
	return false;
}

?>
