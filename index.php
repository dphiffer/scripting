<?php

// Update from GitHub webhook
require_once 'lib/update.php';

// Helper functions
require_once 'lib/functions.php';

// Base config
$title = 'Introduction to Scripting Languages';
$base_path = '/scripting';

// Determine the filename based on the URL
$filename = get_filename($base_path);

// Get the HTML and page title
$html  = get_html($filename);
$title = get_title($title, $html);

// Get header/footer HTML
$header_html = get_partial('header');
$footer_html = get_partial('footer');

// Class for page-specific CSS
$page_class = strtolower(preg_replace('/[^a-zA-Z-]+/', '-', $filename));

// Kick off the page template
require_once 'lib/template.php';

?>
