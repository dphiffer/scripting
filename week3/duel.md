<!--

Title: Preparing for the duel (part 2)

-->
# Exercise: preparing for the duel (part 2)

This week we will continue our work on our tiny ASCII duel, creating a web page for our three animation frames.

## Download your files from GitHub

Go to your GitHub repository from last week, the URL should be something like github.com/__username__/exercise-1-duel. You can navigate to it from the GitHub.com homepage, look for "Your repositories" in the right sidebar.

* Click on the __Download ZIP__ button in the right sidebar
* Go to your __Downloads__ folder and unzip the `exercise-1-duel` folder by double-clicking on it
* Rename the `exercise-1-duel` folder to `exercise-2-duel`
* Move the folder to somewhere you can easily find it, such as your __Documents__ folder

## Create a new repository

* Open the __GitHub Desktop__ app
* Click on the "+" icon in the top-left part of the window
* Choose the __Create__ tab
* Type in `exercise-2-duel` as the repository __Name__
* Make sure the __Local Path__ matches where you saved your unzipped folder
* Click the __Create Repository__ button

![Create repository](http://phiffer.org/scripting/week3/images/create-repo.jpg)

## Publish your repository

You should see your three files from last week: `duel1.txt`, `duel2.txt`, and `duel3.txt`. We'll use those as a starting point.

* Write a brief commit description, "First commit" is fine
* Click the __Commit to master__ button

![First commit](http://phiffer.org/scripting/week3/images/first-commit.jpg)

You should see your three files in the __History__ tab.

* Click on the __Publish__ button on the top right of the screen
* Enter `exercise-2-duel` as the repository __Name__
* Click the __Push Repository__ button to upload your files to GitHub

![Publish repository](http://phiffer.org/scripting/week3/images/publish-repo.jpg)

Notice the __Publish__ button has turned into a __Sync__ button. From now on, if you need to upload your changes, you'll follow these three steps: 1. go to the "Uncommitted changes" tab, 2. *commit* your changes, 3. *sync* your commits.

![Starting point](http://phiffer.org/scripting/week3/images/starting-point.jpg)

## Creating a new HTML page

We will now combine our 3 text files into a single HTML page.

* Launch the Atom editor app
* Close the window for your first exercise
* Go to the __File__ menu and choose __Open__
* Open your new `exercise-2-duel` folder

You should see your 3 files in the project sidebar.

* Go to the __File__ menu and choose __New File__
* Save your empty file as `duel.html`

You should see a fourth `duel.html` file appear in your project sidebar.

![duel.html](http://phiffer.org/scripting/week3/images/duel-html.jpg)

## HTML template

Copy and paste this HTML template into your new file.

```html
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>The Duel</title>
  </head>
  <body>

  </body>
</html>
```

* Save your changes (keyboard shortcut ⌘-S)
* Go to GitHub Desktop
* Switch to the "Uncommitted changes" tab
* Type a short description and click the __Commit to master__ button
* Click the __Sync__ button to push your commit to GitHub

## Three DIV elements

We are going to add some HTML in the `<body>` element. Type in the following code in between `<body>` and `</body>`. Don't copy/paste this part, it's good to start building the muscle memory in your fingers for HTML.

```html
<div id="duel1">

</div>
```

Try to match the indentation of the existing template.

* Copy and paste your HTML so you end up with 3 div elements
* Change the `id="duel1"` parts on the copied DIVs so you have `duel1`, `duel2`, and `duel3`.

![Three DIVs](http://phiffer.org/scripting/week3/images/three-divs.jpg)

## Six ASCII figures

Open each of the three .txt files and copy/paste each step of the duel into your three DIV elements.

![Six figures](http://phiffer.org/scripting/week3/images/six-figures.jpg)

* Save your changes to `duel.html`
* Create a commit in the GitHub Desktop app
* Sync your changes to GitHub

## Check your work

Let's open up the HTML file in a web browser.

* Open the Google Chrome browser
* Go to the __File__ menu and choose __Open File__ (keyboard shortcut ⌘-O)
* Find `duel.html` and click the __Open__ button

Ack, it's formatted all wrong!

![Oh noes!](http://phiffer.org/scripting/week3/images/oh-noes.jpg)

## Add some style

Let's add some CSS to our HTML document to fix this. Type the following into your HTML file (again, try not to copy/paste), after the line `<title>The Duel</title>`, but before `</head>`.

```html
<style>
div {
  white-space: pre;
}
</style>
```

Save your file and reload the page in Google Chrome.

![Getting closer](http://phiffer.org/scripting/week3/images/closer.jpg)

We're getting closer, but the ASCII doesn't look right still. Type in one more CSS property to change the font.

```html
<style>
div {
  white-space: pre;
  font-family: monospace;
}
</style>
```

* Save your changes to `duel.html`
* Reload the page in Chrome

Now you should see something very much like .txt version.

![Got it](http://phiffer.org/scripting/week3/images/got-it.jpg)

## Upload your changes

We're all done!

* Got to the GitHub Desktop app
* Create one last commit
* Sync your commit to GitHub
