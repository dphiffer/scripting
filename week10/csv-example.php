<?php

header('Content-Type: text/plain');

$fh = fopen('usa-states.csv', 'r');
$rows = [];
$first_row = true;
while ($cols = fgetcsv($fh)) {
	if ($first_row) {
		$first_row = false;
		continue;
	}
	$rows[] = $cols;
}
fclose($fh);

function state_added_sort($a, $b) {
	if ($a[3] < $b[3]) {
		return - 1;
	} else {
		return 1;
	}
}
usort($rows, 'state_added_sort');

print_r($rows);

?>
