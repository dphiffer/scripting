<?php

$files = glob('msg/*.json');
$messages = array();
foreach ($files as $file) {
	$msg = json_decode(file_get_contents($file));
	if (!empty($msg)) {
		$messages[] = $msg;
	}
}
header('Content-Type: application/json');
echo json_encode(array(
	'msgs' => $messages
));

?>
