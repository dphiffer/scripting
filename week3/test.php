<?php

require_once dirname(__DIR__) . '/lib/test-functions.php';

$username = test_username();
$repo     = test_repo('exercise-2-duel');
$dir      = __DIR__ . "/test/$username";
$url      = "https://github.com/$username/$repo.git";

echo "Testing $username, $repo\n";

test_download($url, $dir);
$files = test_files($dir, array(
  'html' => 'duel.html',
  'txt1' => 'duel1.txt',
  'txt2' => 'duel2.txt',
  'txt3' => 'duel3.txt'
));
extract($files);

$expected = array(
  'duel1' => '<div id="duel1">',
  'duel2' => '<div id="duel2">',
  'duel3' => '<div id="duel3">',
  'monospace' => 'font-family: monospace;',
  'whitespace' => 'white-space: pre;'
);
test_expected($html, $expected);

test_regexes($html, array(
  'duel1' => "#
    \s*~O  O~
    \s*<|/\|>
    \s* |\ |\
    #xms",
  'duel2' => "#
    \s*~O  O~
    \s*<|--|>
    \s*/ \/ \
    #xms",
  'duel3' => "#
    \s*~O  O~
    \s*<|\/|>
    \s* |\ |\
    #xms"
));

echo "------------------\n";
echo "PASS\n";
exit(0);
