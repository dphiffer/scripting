<?php

date_default_timezone_set('America/Chicago');
$fh = fopen('output.log', 'a');

function log_message($message) {
	global $fh;
	if (is_array($message)) {
		$message = print_r($message, true);
	}
	$date_time = date('Y-m-d H:i:s');
	fwrite($fh, "$date_time $message\n");
}

log_message('hello!');
log_message("Another message");
log_message($_SERVER);

fclose($fh);

?>
