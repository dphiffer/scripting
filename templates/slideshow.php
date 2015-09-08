<!DOCTYPE html>
<html>
  <!-- Based on Remark.js http://remarkjs.com/ -->
  <head>
    <title><?php echo $title; ?></title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="<?php echo $base_path; ?>/templates/slideshow.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_path; ?>/lib/favicon.ico">
    <?php

    if (!empty($stylesheet)) {
      echo "<link rel=\"stylesheet\" href=\"$base_path/$stylesheet\">\n";
    }

    ?>
  </head>
  <body>
    <textarea id="source"><?php echo $markdown; ?></textarea>
    <script src="<?php echo $base_path; ?>/lib/remark.js"></script>
    <script>
      var slideshow = remark.create();
    </script>
  </body>
</html>
