# Making it your own

Much like the [first project](/scripting/project1), the last step is probably the most important. We have a simple mechanism for accepting user input, and then making their input linkable. It's a tiny wiki that uses the URL query string as its data storage mechanism.

## Look at existing single-serving sites

Take a look at other single-serving sites that have been made. There's a big list of them [at kottke.org](http://kottke.org/08/02/single-serving-sites), although many of those links have stopped working. You may also want to look at the [Wikipedia article](https://en.wikipedia.org/wiki/Single-serving_site), or the [Know Your Meme](http://knowyourmeme.com/memes/subcultures/single-serving-site) page.

## Consider adding more inputs

You could add additional text inputs, or link to outside image URLs, etc. If you decide to go this route, you'll need to parse each input from the URL with a slightly more complicated regular expression:

```js
var query  = location.search;
var inputs = query.match(/input1=([^&]*)&input2=([^&]*)/);
var input1 = inputs[1];
var input2 = inputs[2];
```

Or, if you have three inputs, the regular expression would look like:  
`/input1=([^&]*)&input2=([^&]*)&input3=([^&]*)/`

## Consider using other JavaScript objects

Check out the reference documentation in the JavaScript “Rhino” book for `Date` and `Math.random()`, these may prove helpful for creating slightly more complex sites.

## Commit + sync frequently to GitHub

If you commit your changes frequently, you may save yourself from getting stuck along the way. Think of it as your safety net, an easy way to roll back to an earlier known-working revision if you paint yourself into a corner.

## Let me know if you need help

Please get in touch sooner than later if you get stuck! As with most things, the earlier you start the better. The best way to get help is to upload your code onto GitHub and send me a link via email.
