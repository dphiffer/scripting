<!--

template: slideshow.php

-->

class: center, middle

# CSS Positioning (part 2)

---

layout: true

## `display` property

* Controls how elements fit into the content flow
* Three most common values: `none`, `inline`, `block`

```html
<div class="a">DIV A</div>
<div class="b">DIV B</div>
<div class="c">DIV C</div>
<span class="a">span a</span>
<span class="b">span b</span>
<span class="c">span c</span>
```

---

class: display

<div class="display-example">
	<div class="a">DIV A</div>
	<div class="b">DIV B</div>
	<div class="c">DIV C</div>
	<span class="a">span a</span>
	<span class="b">span b</span>
	<span class="c">span c</span>
</div>

---

class: display

```css
.b {
	display: none;
}
```

<div class="display-example display-none-example-transition">
	<div class="a">DIV A</div>
	<div class="b">DIV B</div>
	<div class="c">DIV C</div>
	<span class="a">span a</span>
	<span class="b">span b</span>
	<span class="c">span c</span>
</div>

---

class: display

```css
.b {
	display: none;
}
```

<div class="display-example display-none-example">
	<div class="a">DIV A</div>
	<div class="b">DIV B</div>
	<div class="c">DIV C</div>
	<span class="a">span a</span>
	<span class="b">span b</span>
	<span class="c">span c</span>
</div>

---

class: display

```css
.b {
	display: inline;
}
```

<div class="display-example display-inline-example">
	<div class="a">DIV A</div>
	<div class="b">DIV B</div>
	<div class="c">DIV C</div>
	<span class="a">span a</span>
	<span class="b">span b</span>
	<span class="c">span c</span>
</div>

---

class: display

```css
.b {
	display: block;
}
```

<div class="display-example display-block-example">
	<div class="a">DIV A</div>
	<div class="b">DIV B</div>
	<div class="c">DIV C</div>
	<span class="a">span a</span>
	<span class="b">span b</span>
	<span class="c">span c</span>
</div>

---

layout: false
class: display

# `inline` vs. `block`

* Inline fills only what it takes up, flows horizontally
* Block fills the full available width, stacks vertically

<div class="display-example">
	<div class="foo">DIV FOO FOO FOO</div>
	<div class="bar">DIV BAR BAR BAR</div>
	<span class="foo">span foo foo foo foo foo foo</span>
	<span class="bar">span bar bar bar bar bar bar</span>
</div>

```css
.foo {
	background: #faa; /* red */
}

.bar {
	background: #cf9; /* green */
}
```

---

class: display

# `inline` vs. `block`

* Block can be assigned a width and height
* Inline ignores width/height

<div class="display-example display-dimensions-example">
	<div class="foo">DIV FOO FOO FOO</div>
	<div class="bar">DIV BAR BAR BAR</div>
	<span class="foo">span foo foo foo foo foo foo</span>
	<span class="bar">span bar bar bar bar bar bar</span>
</div>

```css
.foo {
	background: #faa; /* red */
	width: 125px;
}

.bar {
	background: #cf9; /* green */
	width: 150px;
}
```

---

class: display

# `inline-block`

* There are many other `display` values
* `inline-block` is kind of a platypus hybrid

<div class="display-example display-dimensions-example">
	<div class="foo">DIV FOO FOO FOO</div>
	<div class="bar">DIV BAR BAR BAR</div>
	<div class="baz">DIV BAZ BAZ BAZ</div>
	<span class="foo">span foo foo foo foo foo foo</span>
	<span class="bar">span bar bar bar bar bar bar</span>
	<span class="baz">span baz baz baz baz baz baz</span>
</div>

```css
.foo {
	background: #faa; /* red */
	width: 125px;
}

.bar {
	background: #cf9; /* green */
	width: 150px;
}

.baz {
	background: #9cf; /* blue */
	display: inline-block;
	width: 175px;
}
```

---

layout: true

# Floats

* Switch `block` elements to stack horizontally
* `inline` content flows around floated elements

---

---

class: float

```html
<div>DIV</div>
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

<div class="float-example">
	<div>DIV</div>
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>

---

class: float

```html
<div class="floated">DIV</div>
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

```css
.floated {
	float: right;
}
```

<div class="float-example">
	<div class="floated-right">DIV</div>
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>

---

class: float

```html
<div class="floated">DIV</div>
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

```css
.floated {
	float: left;
}
```

<div class="float-example">
	<div class="floated-left">DIV</div>
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>

---

class: float

```html
<div class="floated">DIV</div>
<div class="floated">DIV</div>
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

```css
.floated {
	float: left;
}
```

<div class="float-example">
	<div class="floated-left">DIV</div>
	<div class="floated-left">DIV</div>
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>

---

class: float

```html
<div class="floated">DIV</div>
<div class="floated">DIV</div>
<div class="floated">DIV</div>
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

```css
.floated {
	float: left;
}
```

<div class="float-example">
	<div class="floated-left">DIV</div>
	<div class="floated-left">DIV</div>
	<div class="floated-left">DIV</div>
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>

---

class: float

```html
<div class="floated">DIV</div>
<div class="floated">DIV</div>
<div class="floated">DIV</div>
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

```css
.floated {
	float: left;
	width: 33.33%;
}
```

<div class="float-example float-columns-example">
	<div class="floated-left">DIV</div>
	<div class="floated-left">DIV</div>
	<div class="floated-left">DIV</div>
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>

---

class: float

```html
<div class="floated">DIV DIV</div>
<div class="floated">DIV DIV DIV DIV DIV DIV DIV</div>
<div class="floated">DIV DIV DIV DIV</div>
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

```css
.floated {
	float: left;
	width: 33.33%;
}
```

<div class="float-example float-columns-example">
	<div class="floated-left">DIV DIV</div>
	<div class="floated-left">DIV DIV DIV DIV DIV DIV DIV</div>
	<div class="floated-left">DIV DIV DIV DIV</div>
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>

---

layout: false
class: float

# Clearing floats

* The `clear` property says “we’re done stacking horizontally, resume vertical stacking.”

```html
<div class="floated">DIV DIV</div>
<div class="floated">DIV DIV DIV DIV DIV DIV DIV</div>
<div class="floated">DIV DIV DIV DIV</div>
<br class="clear">
<span>Lorem ipsum dolor sit amet, 
consectetur adipiscing elit, sed do
eiusmod tempor incididunt ut...</span>
```

```css
.floated {
	float: left;
	width: 33.33%;
}

.clear {
	clear: both;
}
```

<div class="float-example float-columns-example">
	<div class="floated-left">DIV DIV</div>
	<div class="floated-left">DIV DIV DIV DIV DIV DIV DIV</div>
	<div class="floated-left">DIV DIV DIV DIV</div>
	<br class="clear">
	<span>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</span>
</div>
