# CSS changes

At this point you should have a basic form, with a system default text input. If you open the `what.html` file in your web browser, you should see something like the the screenshot below.

![Unstyled textarea](images/unstyled-textarea.jpg){.border}

## Add a new selector

* Open the file `what.css`.
* Add the following rules just below the `body { ... }` part of your CSS rules.

```css
textarea {
	font-family: helvetica, sans-serif;
	font-size: 24px;
	width: 100%;
	height: 1000px;
	border: none;
}
```

Now if you reload your browser, you should see a styled version of the same `<textarea>`, that looks more like this:

![Unstyled textarea](images/styled-textarea.jpg){.border}

[Continue](form-submission){.button}
