# HTML changes

We need to modify the HTML of our template page to include form elements allowing for user input. We’ll also want to add in the HTML that includes JavaScript onto the page.

## Change the `<h1>` prompt

* Change the contents of the `<h1>` tag. For now you can just make it: "What is going on?"

```html
<h1>What is going on?</h1>
```

## Add the form

* Replace all the text paragraphs in `what.html` with the following.

```html
<form action="what.html">

</form>
```
The form is what controls the details about how our form submits its data. In this case it's submitting to the `what.html` file.

## Add the `<textarea>`

* Add a `<textarea>` element inside the `<form>` element.

```html
<textarea name="what" id="what" placeholder="What is happening?"></textarea>
```

This will allow the user to enter text into the page.

## Add the `<script>`

* Near the bottom of your HTML, just before the `</body>` close tag, add the following.

```html
<script src="what.js"></script>
```

[Continue](css-changes){.button}
