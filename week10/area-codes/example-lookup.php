<?php

header('Content-Type: text/plain');

// Lookup table
$lookup = array();

// Read each line of the CSV
$fh = fopen('area-codes.csv', 'r');
while ($line = fgetcsv($fh)) {
	$summary = implode(", ", $line);
	echo "$summary\n";
	$area_code = $line[0];
	$lookup[$area_code] = $line;
}
fclose($fh);

$json = json_encode($lookup);
file_put_contents('area-code.json', $json);

?>
