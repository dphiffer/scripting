<?php

$php = '/usr/bin/php';

$users = array(
  'dphiffer'                  => 'Dan',
  'apawelczyk'                => 'Andrei',
  'brandondadam'              => 'Brandon',
  'cjsams'                    => 'Caleb',
  'ianjmccauley'              => 'Ian',
  'GigaJake'                  => 'Jake',
  'bibliophile94'             => 'Katrina',
  'msgal97'                   => 'Katy',
  'IntroToScriptingLanguages' => 'Leo',
  'mrpib909'                  => 'Ryan'
);

if (empty($argv[1])) {
  echo "Usage: test.php week[n]\n";
  exit(1);
}

$dir = $argv[1];
if (!file_exists($dir)) {
  echo "Not found: $dir\n";
  exit(1);
}

$max_width = 0;
foreach ($users as $user => $name) {
  $label = "$name ($user)";
  if (strlen($label) > $max_width) {
    $max_width = strlen($label);
  }
}

foreach ($users as $user => $name) {
  $status  = exec("$php -f $dir/test.php $user");
  $label   = "$name ($user)";
  $spacing = str_repeat(' ', $max_width + 2 - strlen($label));
  echo "$label:$spacing$status\n";
}

echo "Done\n";
exit(0);
