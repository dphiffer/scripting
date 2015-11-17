<?php

$messages = array();
$known = explode(',', $_POST['known']);
$files = glob('msg/*.json');
foreach ($files as $filename) {
	$id = substr($filename, 4, -5);
	if (!in_array($id, $known)) {
		$msg = json_decode(file_get_contents("msg/$id.json"));
		if (!empty($msg)) {
			$messages[] = $msg;
		}
	}
}
header('Content-Type: application/json');
echo json_encode(array(
	'msgs' => $messages
));

?>
