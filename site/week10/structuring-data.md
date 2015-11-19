<!--

template: slideshow.php

-->

class: center, middle

# Structuring data

---

# Quick recap

* File handles
* Reading a CSV file
* Writing a log file
* Simpler file I/O

---

layout: true

### Quick recap

---

# File handles

```php
<?php

// $fh is a file handle. In PHP its datatype is "resource," kind of
// like a pointer to some external entity.

// fopen() takes two arguments: the filename, and a mode. Mode can be:
//   'r'  (read-only)
//   'a'  (append-only)
//   'w+' (read/write)

$fh = fopen('area-codes.csv', 'r');

?>
```

---

# Reading a CSV file

```php
<?php

// Data structure: Area Code, Country, State, City
$fh = fopen('area-codes.csv', 'r');

// Setup data structure
$rows = array();

// Loop over each row in the CSV file
while ($row = fgetcsv($fh)) {
	$rows[] = $row;
}

// We have an array of all the CSV data!
print_r($rows);

?>
```

---

# Writing a log file

```php

function dbug($message) {
	// Setup a file handle if one hasn't been created yet
	global $_dbug_fh;
	if (empty($_dbug_fh)) {
		$_dbug_fh = fopen('dbug.log', 'a');
	}
	
	// Format data structures for human readability
	if (!is_scalar($message)) {
		$message = print_r($message, true);
	}
	
	// Write a timestamped message to the log
	$date_time = date('Y-m-d H:i:s');
	fwrite($_dbug_fh, "[$date_time] $message\n");
}

?>
```

---

# Simpler file I/O

```php
<?php

// Read the entire file contents in one shot
$json = file_get_contents('area-codes.json');

// Decode JSON format
$area_codes = json_decode($json);

print_r($area_codes);

?>
```

---

layout: false

# Challenge: area code lookup

```php
<?php

// Data structure: Area Code, Country, State, City
$fh = fopen('area-codes.csv', 'r');

// Setup data structure
$rows = array();

// Loop over each row in the CSV file
while ($row = fgetcsv($fh)) {
	$rows[] = $row;
}

// We have an array of all the CSV data!
print_r($rows);

?>
```

---

### $rows

```txt
Array
(
    [0] => Array
        (
            [0] => area_code
            [1] => country
            [2] => state
            [3] => city
        )

    [1] => Array
        (
            [0] => 201
            [1] => United States
            [2] => New Jersey
            [3] => Jersey City
        )

    [2] => Array
        (
            [0] => 202
            [1] => United States
            [2] => District of Columbia
            [3] => (All Locations)
        )
```

---

# One approach: `if` statement

```php
<?php

// Data structure: Area Code, Country, State, City
$fh = fopen('area-codes.csv', 'r');

// Loop over each row in the CSV file
while ($row = fgetcsv($fh)) {
	$query = $_GET['area_code'];
	$area_code = $row[0];
	if ($query == $area_code) {
		print_r($row);
	}
}

?>
```

---

# Another approach: associative array lookup

```php
<?php

// Associative array lookup
$lookup = array();

// Data structure: Area Code, Country, State, City
$fh = fopen('area-codes.csv', 'r');
while ($row = fgetcsv($fh)) {
	$area_code = $row[0];
	$lookup[$area_code] = $row;
}

$query = $_GET['area_code'];
if (!empty($lookup[$query])) {
	print_r($lookup[$query]);
}

?>
```

# Save the lookup as JSON...

```php
<?php

// Associative array lookup
$lookup = array();

// Data structure: Area Code, Country, State, City
$fh = fopen('area-codes.csv', 'r');
while ($row = fgetcsv($fh)) {
	$area_code = $row[0];
	$lookup[$area_code] = $row;
}

file_put_contents('area-codes.json', $lookup);

?>
```

---

# ... Now our program is much simpler

```php
<?php

// No need to repeat the work of associating
//   area code => details
$area_codes = file_get_contents('area-codes.json');
$lookup = json_decode($area_codes);

$query = $_GET['area_code'];
if (!empty($lookup[$query])) {
	print_r($lookup[$query]);
}

?>
```
