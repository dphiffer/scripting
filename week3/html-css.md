<!--

template: slideshow.php

-->

class: center, middle

# Intro to HTML + CSS

---

# HTML

* HyperText Markup Language
* The bones of the web page
* Each page is made of HTML *elements*
* Each element is made of of *tags* and *text content*
* Some elements have *attributes*
* We will be using HTML 5 exclusively

---

__Input__

```html
HTML is basically plain text, plus some extra stuff.
    The   spacing   mostly   gets   ignored.
You have to specifically add line breaks,<br>like this.
<p>Or, even better, with a paragraph.</p>
<b>This text will be bold.</b>
<strong>This text will also be bold. <em>And italic</em></strong>
```

__Output__

HTML is basically plain text, plus some extra stuff.
    The   spacing   mostly   gets   ignored.
You have to specifically add line breaks,<br>like this.
<p>Or, even better, with a paragraph.</p>
<b>This text will be bold.</b>
<strong>This text will also be bold. <em>And italic</em></strong>

---

# Open tag, close tag

* Each element describes or modifies the content enclosed between its tags
* Open tags, like `<h1>` and `<i>`, are matched by a corresponding close tag, like `</h1>` and `</i>`
* Tags must be closed in the order they’re opened  

```html
<!-- This is wrong. -->
<h1>hello <i>world</h1></i>

<!-- This is right. -->
<h1>hello <i>world</i></h1>
```

Note: `<!-- ... -->` is how you add an HTML comment. It gets ignored by the browser.

---

# Self-closing tags

* Some elements, like `<img>` (image), `<br>` (line break), and `<hr>` (horizontal rule), don’t need closing tags
* They don’t enclose anything, they just *are*  
  ```html
  First line<br>
  Second line: <img src="thing.jpg" alt="A thing">
  <hr>
  New section
  ```
* You may sometimes see a slash at the end of a self-closing tag, `<img />`, it's not necessary.

---

# Attributes, by example

* `href` defines where the link goes  
  ```html
  <a href="portfolio.html">my portfolio</a>
  ```
* `src` defines where the image gets loaded from  
  ```html
  <img src="cat.gif" alt="Cat shenanigans">
  ```
* `class` allows us to apply styles  
  ````html
  <span class="highlight">...</span>
  ```
* `id` names a part of the page (and lets us apply styles)  
  ```html
  <section id="introduction">...</section>
  ```

---

# Cascading StyleSheets (CSS)

* The skin of the web page
* The page is styled by a set of *selectors*
* Each selector contains a set of *properties*
* Each property assigns a *value*

```css
a {                   /* Refers to <a> tags, the links on the page */
  color: red;         /* Sets the color property to be red */
  font-weight: bold;  /* Makes the text bold */
}                     /* The properties get enclosed within { ... } */
```

Note: `/* ... */` is how you add a CSS comment. It gets ignored by the browser.

---

# Selector Types

* `h1 { margin: 10px; } /* by element */`  
  ```html
  <h1>Page title</h1>
  ```
--
* `.highlight { background: #ff9; } /* by class */`  
  ```html
  <span class="highlight">lorem ipsum</span>
  ```
--
* `#introduction { font-size: 150%; } /* by ID */`
  ```html
  <section id="introduction">lorem ipsum</section>
  ```
--
* `h2 em { font-weight: bold; } /* by ancestor */`  
  ```html
  <h2>Hello <em>world</em></h2>
  ```

---

layout: true

### CSS properties

.footnote[Full listing [available from W3C](http://www.w3.org/TR/CSS2/propidx.html)]

---

# An incomplete list

* Font + Text
* Colors + Backgrounds
* Size
* Position
* Spacing

---

# Font + Text

```css
font-family: "Helvetica Neue", arial, sans-serif;
font-size: 10px;
line-height: 20px;
font-weight: bold;
font-style: italic;
text-align: center;
text-transform: uppercase;
text-decoration: underline;
white-space: pre;
```

---

# Colors + Backgrounds

```css
color: #474747;
background-color: transparent;
background-color: rebeccapurple;
background-color: linear-gradient(to bottom, #1e5799 0%, #7db9e8 100%);
background-image: url('pattern.png');
background-repeat: no-repeat;
background-size: 100px 50px;
background-position: center;
background-attachment: fixed;
```

---

# Position

```css
display: none;
visibility: hidden;
position: absolute;
left: 100px;
top: 50px;
z-index: 3;
float: left;
clear: both;
```

---

# Size

```css
width: 80%;
height: 100px;
max-width: 100px;
min-height: 100px;
box-sizing: border-box;
```

---

# Spacing

```css
margin: 10px;                 /* 10px all around */
margin: 15px 10px;            /* Order: top/bottom (15px), left/right (10px) */
margin: 10px 10px 15px 10px;  /* Order: top, right, bottom, left */
margin-left: -20px;           /* Margins can be negative */
border: 5px solid red;        /* border-width, border-style, border-color */
padding-top: 100px;
letter-spacing: 1px;
word-spacing: 5px;
text-indent: 10px;
```

---

layout: true

### CSS Box Model

---

```
+-------------------------------------+
|               margin                |
|   +-----------------------------+   |
|   |           border            |   |
|   |   +---------------------+   |   |
|   |   |       padding       |   |   |
|   |   |   +-------------+   |   |   |
|   |   |   |             |   |   |   |
|   |   |   |   content   |   |   |   |
|   |   |   |             |   |   |   |
|   |   |   +-------------+   |   |   |
|   |   |                     |   |   |
|   |   +---------------------+   |   |
|   |                             |   |
|   +-----------------------------+   |
|                                     |
+-------------------------------------+

```
---

```
+-------------------------------------+
|               margin                |   .box {    
|   +-----------------------------+   |       width: 70px;
|   |           border            |   |       padding: 10px;
|   |   +---------------------+   |   |       border: 5px solid #ccc;
|   |   |       padding       |   |   |       margin: 15px;
|   |   |   +-------------+   |   |   |   }
|   |   |   |             |   |   |   |
|   |   |   |   content   |   |   |   |
|   |   |   |             |   |   |   |
|   |   |   +-------------+   |   |   |
|   |   |                     |   |   |
|   |   +---------------------+   |   |
|   |                             |   |
|   +-----------------------------+   |
|                                     |
+-------------------------------------+

```

<div class="box-model-example">
  <div class="box">lorem</div>
  <div class="box">ipsum</div>
</div>

---

layout: false

# Coming up

* Intro to JavaScript
* CSS Positioning
