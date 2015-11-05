<?php

require_once dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/functions.php';

$return = "$base_path/";
if (!empty($_GET['return']) &&
    substr($_GET['return'], 0, 1) == '/') {
	$return = $_GET['return'];
}

if (!empty($_SESSION['github'])) {
	// Already logged in
	header("Location: $return");
} else {
	session_start();
	$_SESSION['return'] = $return;
}

extract($github_config);
$protocol = get_protocol();
$redirect = "$protocol//{$_SERVER['HTTP_HOST']}$base_path/lib/oauth.php";
$github_login_url = 'https://github.com/login/oauth/authorize';
$github_login_url .= "?client_id=$client_id";
$github_login_url .= "&scope=" . urlencode('admin:repo_hook');
$github_login_url .= "&redirect_uri=" . urlencode($redirect);
$github_login_url .= "&state=" . github_state();
header("Location: $github_login_url");
