<?php

// Base config
require_once 'config.php';

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

// Class for page-specific CSS
$page_class = strtolower(preg_replace('/[^a-zA-Z-]+/', '-', $filename));

// Let's goooo!!
require_once "templates/$template";

?>
