<?php

use \Michelf\MarkdownExtra;

// Parses input text into HTML using PHP Markdown Extra
// https://michelf.ca/projects/php-markdown/extra/
function parse_markdown($markdown) {
	$dir = __DIR__;
  require_once "$dir/markdown/Michelf/MarkdownExtra.inc.php";
  return MarkdownExtra::defaultTransform($markdown);
}

// Looks for either $name.md or $name.html and returns HTML
function get_partial($name) {
  $html = '';
	$dir = dirname(__DIR__) . '/site';
  if (file_exists("$dir/$name.md")) {
    $markdown = file_get_contents("$dir/$name.md");
    $html     = parse_markdown($markdown);
  } else if (file_exists("$dir/$name.html")) {
    $html     = file_get_contents("$dir/$name.html");
  } else if (file_exists("$dir/$name.php")) {
		ob_start();
		include "$dir/$name.php";
		$html = ob_get_contents();
		ob_end_clean();
	}
  return $html;
}

// Sets page title based on global $title and the page's first <h1>
function get_title($base_title, $html, $properties, $title_sep) {
  if (isset($properties['title'])) {
    // Content has set a title property
    $title = trim($properties['title']);
  } else if (preg_match('#<h1>(.+?)</h1>#', $html, $matches)) {
    // Use the first <h1> as the page title
    $title = trim($matches[1]);
  }
  if ($title != $base_title) {
    // Keep the site-wide title, after the page title
    $title = "{$title}{$title_sep}{$base_title}";
  }
  $title = strip_tags($title);
  return $title;
}

// Returns the page HTML or a 404 message if the filename doesn't exist
function get_html($filename) {
  if (!file_exists($filename)) { // Make sure we can actually find the file
    $html = <<<END
    <h1>404 not found</h1>
    <p>Sorry, that page wasn’t found.</p>
END;
  } else {
    $html = file_get_contents($filename);
    if (substr($filename, -3, 3) == '.md') {
      // Parse as Markdown if the filename ends in .md
      $html = parse_markdown($html);
    }
  }
  return $html;
}

function get_markdown($filename) {
  if (substr($filename, -3, 3) != '.md') {
    return null;
  }
  $markdown = file_get_contents($filename);
  $markdown = strip_properties($markdown);
  return $markdown;
}

function get_properties($html) {
  $properties = array();
  $valid_keys = array(
    'template',
    'title'
  );
  if (preg_match('/<\!--(.+?)-->/ms', $html, $matches)) {
    $comment_block = $matches[1];
    preg_match_all('/^(.+?):(.+)$/m', $comment_block, $matches);
    foreach ($matches[1] as $index => $key) {
      $key   = strtolower(trim($key));
      $value = trim($matches[2][$index]);
      if (in_array($key, $valid_keys)) {
        $properties[$key] = $value;
      }
    }
  }
  return $properties;
}

function strip_properties($text) {
  $text = trim($text);
  if (substr($text, 0, 4) == '<!--') {
    $text = preg_replace('/<\!--(.+?)-->/ms', '', $text, 1);
  }
  return $text;
}

// Returns a filename based on the request URL
function get_filename($base_path) {
  $filename = 'site/README.md'; // Default filename
  $path = preg_replace("#^$base_path/#", '', $_SERVER['REQUEST_URI']);

  if ($path != '' && $path != '/') { // If this isn't the homepage

    // Protect against directory traversal
    $filename = str_replace('..', '', $path);

    // Ignore trailing slash
    $filename = preg_replace('#/$#', '', $filename);
		
		// Look inside the site directory
		$filename = "site/$filename";

    // Look for the .md file extension
    if (!file_exists($filename) &&
        file_exists("$filename.md")) {
      $filename .= '.md';
    }

    // Look for the .html file extension
    if (!file_exists($filename) &&
        file_exists("$filename.html")) {
      $filename .= '.html';
    }
  }
  return $filename;
}

function get_stylesheet($filename) {
  $base_name = preg_replace('/^(.+)\.\w+$/', '$1', $filename);
  if (file_exists("$base_name.css")) {
    return "$base_name.css";
  } else {
    return '';
  }
}

function stylesheets() {
  global $base_path, $stylesheet, $template;
  echo "<link rel=\"stylesheet\" href=\"$base_path/$stylesheet\">\n";
  if (!empty($stylesheet)) {
    echo "<link rel=\"stylesheet\" href=\"$base_path/$stylesheet\">\n";
  }
}

function github_controls() {
	global $base_path;
	if (empty($_SESSION['github'])) {
		$path = urlencode($_SERVER['REQUEST_URI']);
		echo "<a href=\"$base_path/lib/login.php?return=$path\">Login with GitHub</a>\n";
	} else {
		// Show logged in user's repos
		github_repos();
	}
}

function github_state() {
	global $github_config;
	extract($github_config);
	$time = floor(time() / 60);
	return md5("$state_seed$client_secret$time");
}

function github_check_state($state) {
	global $github_config;
	extract($github_config);
	$curr_time = floor(time() / 60);
	$curr_state = md5("$state_seed$client_secret$curr_time");
	$last_time = floor((time() - 60) / 60);
	$last_state = md5("$state_seed$client_secret$last_time");
	return ($state == $curr_state ||
	        $state == $last_state);
}

function github_repos() {
	global $base_path;
	$user = github_api('GET', '/user');
	$repos = github_api('GET', '/user/repos', array(
		'affiliation' => 'owner',
		'sort' => 'pushed',
		'direction' => 'desc'
	));
	if (!empty($user->login)) {
		$repo_dir = dirname(__DIR__) . "/students/$user->login";
		echo "Hello, <a href=\"https://github.com/$user->login\">$user->name</a>";
		echo " <a href=\"$base_path/lib/logout.php\" class=\"logout\">logout</a>";
		echo '<ul id="repos">';
		foreach ($repos as $repo) {
			$label = $repo->name;
			$checked = '';
			if (file_exists("$repo_dir/$repo->name")) {
				$label = "<a href=\"$base_path/students/$user->login/$repo->name/\">$label</a>";
				$checked = ' checked="checked"';
			} 
			echo "<li id=\"repo-$repo->name\" class=\"repo\"><label><input type=\"checkbox\"$checked> <span class=\"label\">$label</span></label></li>\n";
		}
		echo '</ul>';
	}
}

function github_api($method, $path, $args = null, $credentials = null, $debug = false) {
	global $base_title, $github_api_debug;
	if (empty($credentials)) {
		$github = json_decode($_SESSION['github']);
	} else {
		$github = $credentials;
	}
	if (empty($args)) {
		$args = array();
	}
	$url = "https://api.github.com$path";
	$method = strtoupper($method);
	if ($method == 'GET' && !empty($args)) {
		$query = array();
		foreach ($args as $key => $value) {
			$query[] = urlencode($key) . '=' . urlencode($value);
		}
		$query = implode('&', $query);
		$url .= "?$query";
	}
	$options = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_USERAGENT => "$base_title website 0.2",
		CURLOPT_HTTPHEADER => array(
			'Accept: application/vnd.github.v3+json',
			"Authorization: token $github->access_token"
		)
	);
	if ($method != 'GET') {
		if ($method == 'POST') {
			$options[CURLOPT_POST] = true;
		} else {
			$options[CURLOPT_CUSTOMREQUEST] = $method;
		}
		if (!empty($args)) {
			$options[CURLOPT_POSTFIELDS] = json_encode($args);
		}
		$options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
	}
	$ch = curl_init();
	curl_setopt_array($ch, $options);
	$response = curl_exec($ch);
	if ($debug) {
		$github_api_debug = array(
			$method => $url,
			'args' => $args,
			'response' => $response,
			'info' => curl_getinfo($ch)
		);
		$log = fopen(dirname(__DIR__) . '/debug.log', 'a');
		$msg = print_r($github_api_debug, true);
		fwrite($log, $msg);
		fclose($log);
	}
	curl_close($ch);
	return json_decode($response);
}

function syscall($cmd, $cwd) {
  $descriptorspec = array(
    1 => array('pipe', 'w'), // stdout is a pipe that the child will write to
    2 => array('pipe', 'w')  // stderr
  );
  $resource = proc_open($cmd, $descriptorspec, $pipes, $cwd);
  if (is_resource($resource)) {
    $output = stream_get_contents($pipes[2]);
    $output .= PHP_EOL;
    $output .= stream_get_contents($pipes[1]);
    $output .= PHP_EOL;
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($resource);
    return $output;
  }
}

function git_current_branch ($cwd) {
  $result = syscall('git branch', $cwd);
  if (preg_match('/\\* (.*)/', $result, $matches)) {
    return $matches[1];
  }
	return 'master';
}

function get_protocol() {
	if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] != 'on') {
		$protocol = 'http:';
	} else {
		$protocol = 'https:';
	}
	return $protocol;
}
