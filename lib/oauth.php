<?php

require_once dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/functions.php';

if (!empty($_GET['code']) && !empty($_GET['state'])) {
	extract($github_config);
	if (!github_check_state($_GET['state'])) {
		echo "Invalid state value.";
		exit;
	}
	if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
		$protocol = 'http';
	} else {
		$protocol = 'https';
	}
	$redirect = "$protocol://{$_SERVER['HTTP_HOST']}$base_path/lib/oauth.php";
	$post_fields = array(
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'code' => $_GET['code'],
		'redirect_uri' => $redirect,
		'state' => $_GET['state']
	);
	$post_string = array();
	foreach ($post_fields as $key => $value) {
		$post_string[] = urlencode($key) . '=' . urlencode($value);
	}
	$post_string = implode('&', $post_string);
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => 'https://github.com/login/oauth/access_token',
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $post_string,
		CURLOPT_HTTPHEADER => array(
			'Accept: application/json'
		)
	));
	$response = curl_exec($ch);
	curl_close($ch);
	session_start();
	
	$github_credentials = json_decode($response);
	$user = github_api('GET', '/user', null, $github_credentials);
	
	if (empty($github_users[$user->login])) {
		echo "Sorry, you aren't on the list of allowed users.";
		exit;
	} else {
		$dir = dirname(__DIR__);
		$github_id = "$dir/students/$user->login.txt";
		if (!file_exists($github_id)) {
			file_put_contents($github_id, $user->id);
		}
	}
	
	$_SESSION['github'] = $response;
	$return = "$base_path/";
	if (!empty($_SESSION['return'])) {
		$return = $_SESSION['return'];
	}
	header("Location: $return");
} else {
	echo "Oops, something has gone wrong.";
}
