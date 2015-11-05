<?php

require_once dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/functions.php';

if (!empty($_POST['repo']) && !empty($_POST['status'])) {
	session_start();
	$user = github_api('GET', '/user');
	$repo_dir = dirname(__DIR__) . "/students/$user->login";
	$repo = $_POST['repo'];
	$repo = preg_replace('/[^0-9a-zA-Z_-]/', '', $repo);
	
	if ($_POST['status'] == 'enable') {
		if (!file_exists($repo_dir)) {
			mkdir($repo_dir);
		}
		if (!file_exists("$repo_dir/$repo")) {
			exec("cd $repo_dir && git clone https://github.com/$user->login/$repo.git");
		}
		
		$protocol = get_protocol();
		$response = github_api('POST', "/repos/{$user->login}/$repo/hooks", array(
			'name' => 'web',
			'config' => array(
				'url' => "$protocol//{$_SERVER['HTTP_HOST']}$base_path/",
				'content_type' => 'form'
			),
			'events' => array('push'),
			'active' => true
		));
		if (!empty($response->id)) {
			file_put_contents("$repo_dir/$repo.txt", $response->id);
		}
		
		echo "<a href=\"$base_path/students/$user->login/$repo\">$repo</a>";
	} else if ($_POST['status'] == 'disable') {
		if (file_exists("$repo_dir/$repo")) {
			exec("rm -rf $repo_dir/$repo");
		}
		if (file_exists("$repo_dir/$repo.txt")) {
			$hook_id = file_get_contents("$repo_dir/$repo.txt");
			github_api('DELETE', "/repos/{$user->login}/$repo/hooks/$hook_id");
			unlink("$repo_dir/$repo.txt");
		}
		echo $repo;
	}
}
