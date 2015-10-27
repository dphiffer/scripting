<!--

template: slideshow.php

-->

class: center, middle

# File input/output

---

# Quick review

* PHP tags
* PHP variables
* File inclusion

---

layout: true

### Quick review

---

# PHP tags

```php
<html>
	<body>
		Hello, I am a normal HTML page.

		<?php

		echo 'But in here I have PHP superpowers!';

		?>

		Back to normal HTML.
	</body>
</html>
```

---

# hello.php?name=Bob

```php
<html>
	<body>
		<?php
		
		// PHP makes it easy to deal with query string values
		$name = $_GET['name'];
		echo "Hello, $name"; // (Double-quotes work differently
		                     //  than single-quotes)
		
		?>
	</body>
</html>
```

---

# Header/Footer

```php
<?php

$title = 'Home page';
include 'header.php';

?>

Page content goes here.

<?php include 'footer.php'; ?>
```

---

layout: false

# File input/output

* File handles
* Working with CSV files
* Logging messages
* `file_get_contents` and `file_put_contents`

---

# File handles

```php
<?php

// Read-only file handle
$read_only   = fopen('file.txt', 'r');

// Read + write file handle
$read_write  = fopen('file.txt', 'w+');

// Write-only file handle
$append_only = fopen('file.txt', 'a');

?>
```

---

# Example: reading a CSV file

```php
<?php

$fh = fopen('data.csv', 'r');
$rows = array();
while ($cols = fgetcsv($fh)) {
	$rows[] = $cols;
	print_r($cols);
}
fclose($fh);

?>
```

---

# Example: writing a log file

```php
<?php

function log_event($message) {
	global $_log_fh;
	if (empty($_log_fh)) {
		// Setup the file handle if one doesn't exist already
		$_log_fh = fopen('output.log', 'a');
	}
	fwrite($_log_fh, $message);
}

?>
```

---

# Simpler file i/o

```php
<?php

$moby_dick  = file_get_contents('moby_dick.txt');
$emoji_dick = str_replace('whale', '🐳');
file_put_contents('emoji_dick.txt', $emoji_dick);

?>
```

.footnote[Emoji Dick is [an actual project!](http://www.emojidick.com/)]
