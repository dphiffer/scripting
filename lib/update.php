<?php

// Based on https://gist.github.com/webjay/3915531

require_once dirname(__DIR__) . '/config.php';
require_once __DIR__ . '/functions.php';

// GitHub will hit us with POST
// https://developer.github.com/webhooks/
if (!empty($_POST['payload'])) {
	
	ignore_user_abort(true);
	$payload = json_decode($_POST['payload']);

  // which branch was committed?
  $branch = substr($payload->ref, strrpos($payload->ref, '/') + 1);

  // If your website directories have the same name as your repository this would work.
  $repository = $payload->repository->full_name;
	if ($base_repo == "https://github.com/$repository") {
		$cwd = dirname(__DIR__);
	} else {
		$cwd = dirname(__DIR__) . "/students/$repository";
	}

  // only pull if we are on the same branch
  if ($branch == git_current_branch($cwd)) {

    // pull from $branch
    $cmd = sprintf('git pull origin %s', $branch);
    $result = syscall($cmd, $cwd);

    $output = '';

    // append commits
    foreach ($payload->commits as $commit) {
      $output .= "{$commit->author->name} ({$commit->author->username})\n";
      foreach (array('added', 'modified', 'removed') as $action) {
        if (count($commit->{$action})) {
          $output .= sprintf('%s: %s; ', $action, implode(',', $commit->{$action}));
        }
      }
      $output .= PHP_EOL;
      $output .= sprintf('because: %s', $commit->message);
      $output .= PHP_EOL;
      $output .= $commit->url;
      $output .= PHP_EOL;
    }

    // append git result
    $output .= PHP_EOL;
    $output .= $result;

    // Log the output
    $fh = fopen(dirname(__DIR__) . "/update.log", 'a');
    fwrite($fh, $output);

    // All done here
    die($output);
  }

}

?>
