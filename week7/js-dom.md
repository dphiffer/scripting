<!--

template: slideshow.php

-->

class: center, middle

# DOM: initializer + traversal

---

# Quick review

* Document Object Model
* jQuery

---

### DOM find methods

* `document.getElementsByTagName('div')` finds  
  `<div></div>`
* `document.getElementById('foo')` finds  
  `<div id="foo"></div>`
* `document.getElementsByClass('bar')` finds  
  `<div class="bar"></div>`
* `document.getElementsByName('baz')` finds  
  `<input name="baz">`

---

### DOM find methods

* Consider this container DIV and links

```html
<div id="container">
	<a href="foo.html">Foo</a>
	<a href="bar.html">Bar</a>
</div>
<a href="baz.html">Baz</a>
```

* How many items does the `links` array contain?

```js
var container = document.getElementById('container');
var links = container.getElementsByTagName('a');
console.log(links.length);
```

---

### DOM query selector methods

* `document.querySelectorAll('div')` finds  
  `<div></div>`
* `document.querySelector('#foo')` finds  
  `<div id="foo"></div>`
* `document.querySelectorAll('.bar')` finds  
  `<div class="bar"></div>`
* `document.querySelectorAll('input[name=baz]')` finds  
  `<input name="baz">`

---

### jQuery methods

* `jQuery('div')` finds  
  `<div></div>`
* `jQuery('#foo')` finds  
  `<div id="foo"></div>`
* `jQuery('.bar')` finds  
  `<div class="bar"></div>`
* `jQuery('input[name=baz]')` finds  
  `<input name="baz">`
	
---

### jQuery getters vs. setters

* Consider these two DIVs

```html
<div id="first">Hello.</div>
<div id="second">Goodbye.</div>
```

* Depending on whether we pass an argument, the jQuery `.html()` method behaves differently

```js
// Without an argument this gets the HTML contents
var hello = jQuery('#first').html();

// With an argument it sets the HTML contents
jQuery('#second').html('Hi.');
```

---

### Self-executing function

* `jQuery()` vs. `$()`
* Defines new a variable namespace

```js
// Outside the function scope

(function($) {
	
	// Inside the function sope
	var $foo = $('#foo');
	$foo.html('Hello, world.');
	
})(jQuery); // Pass the jQuery function, gets aliased to $

// Outside the function scope
```

---

# DOM initializers

```js
function setup() {
	// All our setup code goes here.
}
```

---

# DOM initializers

* This will work, but it's a little hacky

```html
<body onload="setup()">
```

* This is better, since it decouples JS/HTML + allows multiple event listeners

```js
document.addEventListener("load", setup, false);
```

* This will run earlier, before all the images, stylesheets, etc. finish loading

```js
document.addEventListener("DOMContentLoaded", setup, false);
```

---

# jQuery’s `.ready()` method

* The best way to set up your page’s JS
* Self-executing function + DOMContentLoaded

```js
// .ready() is shorthand for DOMContentLoaded
jQuery(document).ready(function($) {
	// We can use $() function here	
	var $foo = $('#foo');
	$foo.html('Hello, world!');
});


// .ready can be invoked multiple times
jQuery(document).ready(function($) {
	var $bar = $('#bar');
	$bar.html('My hovercraft is full of eels.');
});
```

---

# The DOM is a tree structure

```html
<html>
  <head>
    <title>Sample Document</title>
  </head>
  <body>
    <h1>An HTML Document</h1>
    <p>This is a <i>simple</i> document.
  </body>
</html>
```

---

# The DOM is a tree structure

.border[![DOM tree](images/dom-tree.png)]
.footnote[Image: [O'Reilly Safari](https://www.safaribooksonline.com/library/view/javascript-the-definitive/9781449393854/ch15s01.html)]

---

layout: true

# DOM traversal

```html
<div id="grandparent">
	<ul id="parent">
		<li class="child">First</li>
		<li class="child">Second</li>
		<li class="child">Third</li>
	</ul>
</div>
```

---

* Finding parent nodes

```js
var ul = document.getElementById('parent');

// The .parentNode property gives us the node’s parent
var node = ul.parentNode;
console.log(node.getAttribute('id'));
```

---

* Finding parent nodes (with jQuery)

```js
var ul = $('#parent');

// The .parent() method also gives us the nodes’ parents
var node = ul.parent();
console.log(node);
```

---

* Finding parent nodes (with jQuery)

```js
var listItems = $('.child');

// jQuery operates on sets of results (3 parents, in total)
var nodes = listItems.parent();
console.log(nodes);
```

---

* Finding ancestor nodes with jQuery

```js
var listItems = $('.child');

// The .closest() method traverses the tree upward
var $div = listItems.closest('div');
console.log($div); // 3 references to the same <div>
```

---

layout: false

# Other DOM traversal properties

* `childNodes`: an array of children (use `.find()` in jQuery)
* `firstChild`: the first item of `childNodes`
* `lastChild`: the last item of `childNodes`
* `nextSibling`, `previousSibling`: nodes at the same level of the tree
* `document.getElementsByTagName('*')`: get *all* the elements on the page
