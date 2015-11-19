# Polish the user interface

## Show the current text

Let's make the form display the current value of the content.

* Add the following PHP code into your HTML form

```html
<textarea name="content" rows="8" cols="80"><?php

echo $safe_content;

?></textarea>
```

This will pre-set the last value of `$content` into the form.

## Wrap the content in a div

Let's add an ID attribute to help us work with the content text via CSS and JavaScript.

* Move the `echo` command into a new div element

```php
<?php

$safe_content = htmlentities($content);

?>
<div id="content">
	<?php echo $safe_content; ?>
</div>
```

## Add some styles

Refer back to our earlier projects and exercises and use a stylesheet to make the page look a bit nicer. Think about fonts and layout.

## Add some interactivity

* Create a CSS class to toggle the visibility of the content and form.

```css
.hidden {
	display: none;
}
```

* Assign that class to the form so that it's hidden at first: `<form class="hidden">`
* Add a click handler with JavaScript that hides the content and replaces it with the form

```js
$('#content').click(function() {
	$('form').removeClass('hidden');
	$('#content').addClass('hidden');
});
```

* Add a hover state to indicate that the content is editable

```CSS
#content:hover {
	background: #ff9;
}
```

## Update wiki.php

* Commit your changes, and test them out on the live wiki.php

[Continue](own-it){.button}
