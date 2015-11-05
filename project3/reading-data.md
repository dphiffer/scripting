# Reading data

You should have an empty wiki.php file open in your editor.

* Add the following code to wiki.php, to read data from a text file, if it exists

```php
<?php

if (file_exists('wiki.txt')) {
	$content = file_get_contents('wiki.txt');
} else {
	$content = '(no content)';
}

?>
```

# Output the content

Let's output the `$content` variable onto the page. Remember our discussion about cross-site scripting? Make sure to *escape* user input on the way out.

* Add the following to the end of your script (before the `?>`)

```php
$safe_content = htmlentities($content);
echo $safe_content;
```

# Commit, push, clone

* Use the GitHub Desktop app, commit your changes 
* Sync (push) to GitHub
* Go to [phiffer.org/scripting](https://phiffer.org/scripting/) and login from the sidebar
* Click the checkbox next to __project-3-wiki__ to clone your new repository

Once the repository name turns into a link, click on it and click on the link to view wiki.php. You should see a blank page with "(no content)."

[Continue](writing-data){.button}
