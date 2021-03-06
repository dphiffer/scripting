<?php

// Set up session
session_set_cookie_params(60 * 60 * 24 * 365, $base_path);
if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

// Get header/footer HTML
$header_html = get_partial('header');
$footer_html = get_partial('footer');

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="<?php echo $base_path; ?>/templates/main.css">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $base_path; ?>/lib/favicon.ico">
    <?php

    if (!empty($stylesheet)) {
      echo "<link rel=\"stylesheet\" href=\"$base_path/$stylesheet\">\n";
    }

    ?>
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
			<div id="sidebar">
				<?php github_controls(); ?>
			</div>
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
		<script src="<?php echo $base_path; ?>/templates/main.js"></script>
  </body>
</html>
