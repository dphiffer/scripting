<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>/lib/styles.css">
  </head>
  <body>
    <div id="page">
      <header>
        <?php require_once 'header.php'; ?>
      </header>
      <article id="main">
        <?php echo $html; ?>
      </article>
      <footer>
        <?php require_once 'footer.php'; ?>
      </footer>
    </div>
  </body>
</html>
