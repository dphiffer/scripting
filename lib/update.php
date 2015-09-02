<?php

// Based on https://gist.github.com/webjay/3915531

ignore_user_abort(true);

function syscall ($cmd, $cwd) {
  $descriptorspec = array(
    1 => array('pipe', 'w'), // stdout is a pipe that the child will write to
    2 => array('pipe', 'w')  // stderr
  );
  $resource = proc_open($cmd, $descriptorspec, $pipes, $cwd);
  if (is_resource($resource)) {
    $output = stream_get_contents($pipes[2]);
    $output .= PHP_EOL;
    $output .= stream_get_contents($pipes[1]);
    $output .= PHP_EOL;
    fclose($pipes[1]);
    fclose($pipes[2]);
    proc_close($resource);
    return $output;
  }
}

function git_current_branch ($cwd) {
  $result = syscall('git branch', $cwd);
  if (preg_match('/\\* (.*)/', $result, $matches)) {
    return $matches[1];
  }
}

// GitHub will hit us with POST (http://help.github.com/post-receive-hooks/)
if (!empty($_POST['payload'])) {

  $cwd = dirname(__DIR__);
  $payload = json_decode($_POST['payload']);

  // which branch was committed?
  $branch = substr($payload->ref, strrpos($payload->ref, '/') + 1);

  // If your website directories have the same name as your repository this would work.
  $repository = $payload->repository->name;

  // only pull if we are on the same branch
  if ($branch == git_current_branch($cwd)) {

    // pull from $branch
    $cmd = sprintf('git pull origin %s', $branch);
    $result = syscall($cmd, $cwd);

    $output = '';

    // append commits
    foreach ($payload->commits as $commit) {
      $output .= $commit->author->name.' a.k.a. '.$commit->author->username;
      $output .= PHP_EOL;
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
    $fh = fopen("$cwd/update.log", 'a');
    fwrite($fh, $output);

    // All done here
    die($output);
  }

}

?>
