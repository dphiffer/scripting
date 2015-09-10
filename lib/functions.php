<?php

use \Michelf\MarkdownExtra;

// Parses input text into HTML using PHP Markdown Extra
// https://michelf.ca/projects/php-markdown/extra/
function parse_markdown($markdown) {
  require_once 'lib/markdown/Michelf/MarkdownExtra.inc.php';
  return MarkdownExtra::defaultTransform($markdown);
}

// Looks for either $name.md or $name.html and returns HTML
function get_partial($name) {
  $html = '';
  if (file_exists("$name.md")) {
    $markdown = file_get_contents("$name.md");
    $html     = parse_markdown($markdown);
  } else if (file_exists("$name.html")) {
    $html     = file_get_contents("$name.html");
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
  $filename = 'README.md'; // Default filename
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
