<?php

$query = '';
if (!empty($_GET['area_code'])) {
	$query = $_GET['area_code'];
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Area Code lookup</title>
		<meta charset="utf-8">
	</head>
	<body>
		<form>
			<label>
				What telephone area code are you interested in?
				<input name="area_code" type="number" value="<?php echo $query; ?>">
				<input type="submit">
			</label>
		</form>
		<?php

		// Data structure: Area Code, Country, State, City
		$fh = fopen('area-codes.csv', 'r');

		// Loop over each row in the CSV file
		while ($row = fgetcsv($fh)) {
			$area_code = $row[0];
			if ($query == $area_code) {
				$country = $row[1];
				$state = $row[2];
				$city = $row[3];
				echo "That area code is from <strong>$city, $state, $country</strong>";
			}
		}

		?>
	</body>
</html>
