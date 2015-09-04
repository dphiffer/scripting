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
function get_title($title, $html, $separator = ' / ') {
  // Use the first <h1> as the page title
  if (preg_match('#<h1>(.+?)</h1>#', $html, $matches)) {
    if ($matches[1] != $title) {
      // Keep the site-wide title, after the page title
      $title = "{$matches[1]}{$separator}{$title}";
    }
  }
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
