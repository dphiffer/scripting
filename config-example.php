<?php

$base_repo  = 'https://github.com/dphiffer/scripting';
$base_title = 'Introduction to Scripting Languages';
$base_path  = '/scripting';
$template   = 'main.php';
$title_sep  = ' / ';

// Get client ID & secret from https://github.com/settings/applications/new
// The redirect URL is like: http://example.com/base_path/lib/oauth.php
// Make up a random string for the state_seed (use pwgen, for example)
$github_config = array(
	'client_id'     => '',
	'client_secret' => '',
	'state_seed'    => ''
);

// Only allow these users to login
$github_users = array(
	// 'username' => 'Display name'
);

// List of teacher GitHub usernames
$github_teachers = array(
	// 'username'
);
