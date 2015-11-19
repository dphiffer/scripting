<?php

require_once dirname(__DIR__) . '/lib/test-functions.php';

$username = test_username();
$repo     = test_repo('project-1-duel');
$dir      = __DIR__ . "/test/$username";
$url      = "https://github.com/$username/$repo.git";

echo "Testing $username, $repo\n";

test_download($url, $dir);
$files = test_files($dir, array(
  'html' => '*.html'
));
extract($files);



echo "------------------\n";
echo "PASS\n";
exit(0);
