<?php

// Update from GitHub webhook
require_once 'lib/update.php';

// PHP Markdown
require_once 'lib/markdown/Michelf/MarkdownExtra.inc.php';
use \Michelf\MarkdownExtra;

// Default settings
$title = 'Introduction to Scripting Languages';
$github_url = 'https://github.com/dphiffer/scripting/blob/fall-2015';
$base_path = '/scripting';
$filename = 'README.md';

// Derive filename from URL
$path = preg_replace("#^$base_path/#", '', $_SERVER['REQUEST_URI']);
if ($path != '' && $path != '/') { // If this isn't the homepage

  // Protect against directory traversal
  $filename = str_replace('..', '', $path);

  // Ignore trailing slash
  $filename = preg_replace('#/$#', '', $filename);

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

$page_class = strtolower(preg_replace('/[^a-zA-Z-]+/', '-', $filename));

if (!file_exists($filename)) {
  $html = <<<END
  <h1>404 not found</h1>
  <p>Sorry, that page wasn’t found. You probably want to start from the <a href="$base_path/">homepage</a>.</p>
END;
} else {
  $html = file_get_contents($filename);
  if (substr($filename, -3, 3) == '.md') {
    $html = MarkdownExtra::defaultTransform($html);
  }
}

if (preg_match('#<h1>(.+?)</h1>#', $html, $matches)) {
  if ($matches[1] != $title) {
    $title = $matches[1] . " / $title";
  } else {
    $title = $matches[1];
  }
}

$html = preg_replace_callback("#$github_url([a-zA-Z0-9/._-]+)#", function($matches) use ($base_path) {
  $path = $matches[1];
  if (substr($path, -3, 3) == '.md') {
    $path = substr($path, 0, -3);
  }
  return $base_path . $path;
}, $html);

require_once 'lib/template.php';

?>
