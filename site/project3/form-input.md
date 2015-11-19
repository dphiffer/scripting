# Form input

Let's give our wiki an HTML user interface.

## HTML boilerplate

* Wrap your `<?php ... ?>` code in the boilerplate HTML page code

```html
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Wiki</title>
	</head>
	<body>
		<?php
		
		// Your PHP code
		
		?>
	</body>
</html>
```

## HTML Form

* Add an HTML form below the PHP tags

```html
<form action="wiki.php">
	<textarea name="content" rows="8" cols="80"></textarea>
	<input type="submit" value="Save">
</form>
```

## Update wiki.php

* Commit and sync your changes to GitHub
* Reload wiki.php on the browser, and try out your new HTML interface

[Continue](polish-ui){.button}
