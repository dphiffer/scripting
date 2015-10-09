<?php

require_once dirname(__DIR__) . '/config.php';
require_once dirname(__DIR__) . '/lib/functions.php';

function user_html($username, $name) {
	global $base_path;
	$icon_url = "https://identicons.github.com/$username.png";
	$github_id = __DIR__ . "/$username.txt";
	if (file_exists($github_id)) {
		$avatars_num = rand(0, 3);
		$github_id = file_get_contents($github_id);
		$icon_url = "https://avatars$avatars_num.githubusercontent.com/u/$github_id?v=3&s=100";
	}
	$icon = "<img src=\"$icon_url\" width=\"50\" height=\"50\" alt=\"$username\">";
	$user_html = "<h2><a href=\"https://github.com/$username\">$icon$name</a></h2>\n";
	$repos = array();
	if (file_exists(__DIR__ . "/$username")) {
		$user_html .= user_repos($username);
	}
	return $user_html;
}

function user_repos($username) {
	global $base_path;
	$user_html = '';
	$repos = array();
	$dh = opendir(__DIR__ . "/$username");
	while ($file = readdir($dh)) {
		if (substr($file, 0, 1) == '.') {
			continue;
		}
		$repos[] = $file;
	}
	if (!empty($repos)) {
		$user_html .= "<ul>\n";
		foreach ($repos as $repo) {
			$user_html .= "<li><a href=\"$base_path/students/$username/$repo/\">$repo</a></li>\n";
		}
		$user_html .= "</ul>\n";
	}
	return $user_html;
}

$teacher_count = 0;

$html .= "<h1>Students</h1>\n";
foreach ($github_users as $username => $name) {
	if (in_array($username, $github_teachers)) {
		$teacher_count++;
		continue;
	}
	$html .= user_html($username, $name);
}

if ($teacher_count == 1) {
	$html .= "<h1>Teacher</h1>\n";
} else if ($teacher_count > 0) {
	$html .= "<h1>Teachers</h1>\n";
}

foreach ($github_users as $username => $name) {
	if (in_array($username, $github_teachers)) {
		$html .= user_html($username, $name);
	}
}

$title = "Students$title_sep$base_title";
$page_class = 'students';

require_once dirname(__DIR__) . '/templates/main.php';
