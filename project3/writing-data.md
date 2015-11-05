# Writing data

Now that we can read data from a text file, let's update the contents of the file based on user input.

* Add the following commands to wiki.php, before the part of the code that escapes and outputs the content

```php
if (isset($_GET['content'])) {
	$content = $_GET['content'];
	file_put_contents('wiki.txt', $content);
}
```

This code will look for `?content=____` query parameter in the URL and, if it has been set, will save the new content to wiki.txt.

## Update your live wiki.php

* Add a new commit and sync to GitHub
* Try appending the `?content=foo` query string in the URL for wiki.php

You should see the text "foo" appear on the page instead of "(no content)"

* Try loading wiki.php *without* a query string, so the URL ends in `wiki.php`

You should still see the text "foo." It's been stored in wiki.txt, and until it gets overwritten, will retain the most recent content value.

[Continue](form-input){.button}
