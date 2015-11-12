<?php

if (!empty($_POST['msg'])) {
	$filename = microtime(true);
	$filename = str_replace('.', '_', $filename) . '.txt';
	file_put_contents("msg/$filename", $_POST['msg']);
	$msgs = glob('msg/*.txt');
	foreach ($msgs as $filename) {
		$msg = file_get_contents($filename);
		echo '<p>' . htmlentities($msg) . '</p>';
	}
}

?>
