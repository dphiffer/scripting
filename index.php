<?php

require_once 'lib/markdown/Michelf/Markdown.inc.php';
use \Michelf\Markdown;

$title = 'Introduction to Scripting Languages';
$github_url = 'https://github.com/dphiffer/scripting/blob/fall-2015';
$base_path = '/scripting';
$filename = 'README.md';
$path = preg_replace("#^$base_path/#", '', $_SERVER['REQUEST_URI']);

if ($path != '' && $path != '/') {
  $filename = str_replace('..', '', $path);
  $filename = preg_replace('#/$#', '', $filename);
  if (!file_exists($filename) &&
      file_exists("$filename.md")) {
    $filename .= '.md';
  }
}

if (!file_exists($filename)) {
  $html = <<<END
  <h1>404 not found</h1>
  <p>Sorry, that page wasn’t found. You probably want to start from the <a href="$base_path/">homepage</a>.</p>
END;
} else {
  $markdown = file_get_contents($filename);
  $html = Markdown::defaultTransform($markdown);
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

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>/lib/styles.css">
  </head>
  <body>
    <div id="page">
      <?php echo $html; ?>
    </div>
  </body>
</html>
