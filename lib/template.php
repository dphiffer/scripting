<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>/lib/styles.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_path; ?>/lib/favicon.ico">
  </head>
  <body>
    <div id="page" class="<?php echo $page_class; ?>">
      <?php if (!empty($header_html)) { ?>
        <header>
          <nav class="small">
            <?php echo $header_html ?>
          </nav>
        </header>
      <?php } ?>
      <article id="main">
        <?php echo $html; ?>
      </article>
      <?php if (!empty($footer_html)) { ?>
        <footer>
          <nav>
            <?php echo $footer_html ?>
          </nav>
        </footer>
      <?php } ?>
    </div>
  </body>
</html>
