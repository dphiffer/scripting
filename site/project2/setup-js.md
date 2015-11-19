# Setup JavaScript

Ok, now we're almost getting to the JavaScript part!

## Add your `<script>` tag

Go to the Atom editor.

* Open the file `what.html`
* Add the following right *before* the closing `</body>` tag

```js
<script src="what.js"></script>
```

## Make sure it runs

* Open `what.js` in Atom
* Add the following line of JavaScript code

```js
console.log('Hello!');
```

* Switch to your web browser and choose File &rarr; Open File
* Navigate to `project-2-what` and open `what.html`
* Open the JavaScript Console (⌘-opt-J)

You should see "Hello!" logged to the JavaScript console. If not, you may want to figure what why it's not working before you continue.

[Continue](dom-nodes){.button}
