<!--

template: slideshow.php

-->

class: center, middle

# AJAX + JSON

---

# Quick review

* jQuery traversal methods
* jQuery getters + setters
* `jQuery(document).ready()`

---

layout: true

### jQuery traversal methods

```html
<div id="a">
	<ul id="b">
		<li>foo</li>
		<li>bar</li>
		<li>baz</li>
	</ul>
</div>
```

---

```js
// Find a parent node
var divA = jQuery('#b').parent();

// Result: jQuery([div#a])
```

---

```js
// Find the closest parent
var divA = jQuery('li').closest('div');

// Result: jQuery([div#a, div#a, div#a])
```

---

layout: false

### jQuery getters + setters

```html
<div id="test">
	Hello, world!
</div>
```
--
* Without an argument: return the current value

```js
var hello = jQuery('#test').html();
```
--
* With an argument, set the value

```js
jQuery('#test').html('My hovercraft is full of eels.');
```

---

### jQuery(document).ready()

* Shortcut for `DOMContentReady` event listener
* Kicks off your code once the HTML tree is ready
* Lets you assign `$` variable to `jQuery`

```js
jQuery(document).ready(function($)) {
	// JS goes here
});
```

---

# AJAX

* Stands for Asynchronous JavaScript And XML
--

* Lets you load stuff dynamically using JS, with no page reload
--

* Usually that stuff is JSON (JavaScript Object Notation), not XML
--

* Changes what a web page is: *document* &rarr; *application*

---

# AJAX example

__foo.html__
```html
<div id="foo">
	foo
</div>
<script>
jQuery(document).ready(function($) {
	$.get('bar.txt', function(bar) {
		$('#foo').html(bar);
	});
});
</script>
```
--
__bar.txt__
```txt
My hovercraft is full of eels.
```

---

# AJAX same-origin policy

* If your web page is on *example.com* AJAX only lets you load stuff from *example.com*
* This is a security precaution that only applies to AJAX

```js
jQuery(document).ready(function($) {
	// This won't work
	$.get('https://isitchristmas.com/', function(isXmas) {
		$('#xmasCheck').html('Is it xmas?? ' + isXmas);
	});
});
```

---

# AJAX same-origin policy

* Workaround:  
  `<script src="http://isitchristmas.com/check.js"></script>`
--

* This approach is called JSONP, “JSON with padding,” which we won’t cover for now
--

* A better workaround: [Cross-origin resource sharing](https://en.wikipedia.org/wiki/Cross-origin_resource_sharing), which we also won’t cover

---

# JSON

* Looks a lot like regular JavaScript data

```js
// A JavaScript object
var obj = {
	prop1: "foo",
	prop2: ["bar", "bar"],
	prop3: {
		baz: "baz"
	}
};
```

--

```json
{
	"prop1": "foo",
	"prop2": ["bar", "bar"],
	"prop3": {
		"baz": "baz"
	}
}
```

---

# JSON is the new XML

* Increasingly JSON is the default data exchange format
* [JSON on Wikipedia](https://en.wikipedia.org/wiki/JSON)
* [JSON on Wikipedia, in JSON format](https://en.wikipedia.org/w/api.php?action=mobileview&page=JSON&sections=all&prop=text&format=json)
