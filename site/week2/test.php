<?php

if (empty($argv[1])) {
  echo "Usage: test.php [username]\n";
  exit(1);
}

$username = $argv[1];
$git = '/usr/bin/git';
$repo = 'exercise-1-duel';
$url = "https://github.com/$username/$repo.git";
$dir = __DIR__ . "/test/$username";

echo "Testing $username, $repo\n";

if (!file_exists('test')) {
  mkdir('test');
}

if (!file_exists($dir)) {
  exec("$git clone --quiet $url $dir", $results);
} else {
  exec("cd $dir && $git pull --quiet origin master");
}

if (!file_exists("$dir/duel1.txt") ||
    !file_exists("$dir/duel2.txt") ||
    !file_exists("$dir/duel3.txt")) {
  echo "FAIL: files not found\n";
  exit(1);
}

$duel1 = file_get_contents("$dir/duel1.txt");
$duel2 = file_get_contents("$dir/duel2.txt");
$duel3 = file_get_contents("$dir/duel3.txt");

$duel1_expected = "
~O  O~
<|/\|>
 |\ |\
";

$duel2_expected = "
~O  O~
<|--|>
/ \/ \
";

$duel3_expected = "
~O  O~
<|\/|>
 |\ |\
";

if (trim($duel1) != trim($duel1_expected)) {
  echo "WARNING: duel1.txt didn't match expected\n";
}

if (trim($duel2) != trim($duel2_expected)) {
  echo "WARNING: duel2.txt didn't match expected\n";
}

if (trim($duel3) != trim($duel3_expected)) {
  echo "WARNING: duel3.txt didn't match expected\n";
}

echo "------------------\n";
echo "PASS\n";
exit(0);
