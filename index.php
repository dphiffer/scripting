<?php

// Base config
$base_title = 'Introduction to Scripting Languages';
$base_path  = '/scripting';
$template   = 'main.php';
$title_sep  = ' / ';

// Update from GitHub webhook
require_once 'lib/update.php';

// Helper functions
require_once 'lib/functions.php';

// Determine the filename based on the URL
$filename = get_filename($base_path);
$stylesheet = get_stylesheet($filename);

// Get the HTML and Markdown (if there is Markdown)
$html  = get_html($filename);
$markdown = get_markdown($filename);

// Set up the title and other properties
$properties = get_properties($html);
extract($properties);
$title = get_title($base_title, $html, $properties, $title_sep);

// Let's goooo!!
require_once "templates/$template";

?>
