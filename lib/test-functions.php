<?php

global $git, $curl;
$git  = '/usr/bin/git';
$curl = '/usr/bin/curl';

function test_username() {
  global $argv;
  if (empty($argv[1])) {
    echo "Usage: test.php username [repo]\n";
    exit(1);
  }
  return $argv[1];
}

function test_repo($default_repo) {
  global $argv;
  if (isset($argv[2])) {
    return $argv[2];
  } else {
    return $default_repo;
  }
}

function test_download($url, $dir) {
  global $curl, $git;
  if (!file_exists(dirname($dir))) {
    mkdir(dirname($dir));
  }
  $test_url = preg_replace('/\.git$/', '/', $url);
  if (!file_exists($dir)) {
    exec("$curl --head --silent $test_url", $curl_results);
    $curl_results = implode("\n", $curl_results);
    if (strpos($curl_results, '200 OK') === false) {
      echo "FAIL: repo not found\n";
      exit(1);
    }
    exec("$git clone --quiet $url $dir", $results);
  } else {
    exec("cd $dir && $git pull --quiet origin master", $results);
  }
  return implode("\n", $results);
}

function test_files($dir, $files) {
  $contents = array();
  foreach ($files as $var => $filename) {
    if (!file_exists("$dir/$filename")) {
      echo "FAIL: file $filename not found\n";
      exit(1);
    }
    $contents[$var] = file_get_contents("$dir/$filename");
  }
  return $contents;
}

function test_expected($test, $expected) {
  foreach ($expected as $name => $exists) {
    if (strpos($test, $exists) === false) {
      echo "FAIL: expected $name not found\n";
      exit(1);
    }
  }
}

function test_regexes($test, $regexes) {
  foreach ($regexes as $name => $regex) {
    if (!preg_match($regex, $test)) {
      echo "FAIL: regex $name failed\n";
      exit(1);
    }
  }
}
