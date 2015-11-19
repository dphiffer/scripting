<!--

template: slideshow.php

-->

class: center, middle

# PHP

---

# What is PHP?

* Recursive acronym, __P__HP: __H__ypertext __P__reprocessor
* Originally called *Personal Home Page*, created in 1994 by [Rasmus Lerdorf](https://github.com/rlerdorf) (Etsy)
* Server-side scripting language designed for the web
* Also works as a general purpose scripting language

---

### PHP is [flawed](http://blog.codinghorror.com/the-php-singularity/), but it’s fast, ubiquitous, and easy to learn. And the [documentation](http://php.net/manual/en/) is pretty good.

![Double-clawed hammer](images/hammer.jpg)

---

# In a nutshell

* Kind of C-, Java-, and JavaScript-like
* Two modes, invoked with “PHP tags”
* Variables are prefixed with dollar-signs
* Including files

---

# hello.php

```html
<html>
	<body>
		<!-- A PHP file can be plain HTML -->
		Hello, world!
	</body>
</html>
```

---

# hello.php

```php
<html>
	<body>
		<?php
		
		// Inside the PHP tags is hidden from the browser
		echo "Hello, world!";
		
		?>
	</body>
</html>
```

---

# hello.php

```php
<html>
	<body>
		<?php
		
		// Variables have a dollar-sign prefix
		$message = "Hello, world!";
		echo $message;
		
		?>
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
		echo "Hello, $name";
		
		?>
	</body>
</html>
```

---

# header.php

```html
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<div id="page">
```

# footer.php

```html
		</div>
	</body>
</html>
```

---

# index.php

```php
<?php

$title = 'Home page';
include 'header.php';

?>

(Home page content goes here)

<?php include 'footer.php'; ?>
```

---

# about.php

```php
<?php

$title = 'About page';
include 'header.php';

?>

(About page content goes here)

<?php include 'footer.php'; ?>
```

---

# portfolio.php

```php
<?php

$title = 'Portfolio page';
include 'header.php';

?>

(Portfolio page content goes here)

<?php include 'footer.php'; ?>
```

---

# File inclusion

* Make global changes by modifying header.php and footer.php
* *Don’t repeat yourself* (D.R.Y.) principle
* Other PHP file inclusion methods: `include_once`, `require`, `require_once`
