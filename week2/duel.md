# Exercise: preparing for the duel

In this exercise we are going to create a tiny ASCII art duel. Mostly this will serve as a chance to learn how to use GitHub to save things. Git and GitHub are a little tricky to figure out at first, but they will become more natural with frequent use.

## Create a new repository

To begin our project, we need to create a place on GitHub for it to live; a *repository*. Go to [github.com/new](https://github.com/new){target=__blank} to create a new repository.

*Note: If you get a 404 page, that just means you need to login to GitHub with your username and password.*

* Repository name: `exercise-1-duel`
* Leave everything else as-is, and click the green __Create repository__ button

![Create a new repository](http://phiffer.org/scripting/week2/images/create-repository.jpg){.border}

Once you've created your new repository, GitHub will offer rather elaborate instructions on how to continue. You can ignore those instructions.

## Setup GitHub Desktop

*Note: this exercise is written with the assumption that you're using Mac OS X with the [GitHub Desktop](https://desktop.github.com/) app and [Atom editor](https://atom.io/) installed. The same instructions should still work if you are using Windows.*

* Open the GitHub desktop app
* Click the __Continue__ button to begin

![GitHub setup](http://phiffer.org/scripting/week2/images/github-setup.jpg)

* Type in your GitHub username and password and then click the __Sign In__ button
* Click the __Continue__ button

![Sign into GitHub](http://phiffer.org/scripting/week2/images/sign-in.jpg)

* Enter your name and email address
* Click the button that says __Install Command Line Tools__

*Note: if you already have the `git` command line tools installed, the button may appear grayed out to you.*

![Configure GitHub](http://phiffer.org/scripting/week2/images/config.jpg)

* Click the __Continue__ button
* Click the __Done__ button to finish the setup process (we don't need to add local repositories on the last setup step)

At this point you will see a window with a "tutorial" repository and some little popup windows. We are going to skip the tutorial and proceed with the exercise.

![GitHub tutorial](http://phiffer.org/scripting/week2/images/tutorial.jpg)

* Right-click on the "tutorial" repository on the left and choose __Remove__

Your GitHub desktop app is now ready to use.

![Blank github](http://phiffer.org/scripting/week2/images/github.jpg)

## Clone your repository

* Go to the __File__ menu and choose __Clone repository__
* Select your repository from the list and click the __Clone exercise-1-duel__ button
* Choose a folder to save your work, __Documents__ for example, just be sure you can find it later

![Clone your repository](http://phiffer.org/scripting/week2/images/clone-repository.jpg)

## Setup a new Atom project

* Open the [Atom text editor](https://atom.io/)
* Go to the __File__ menu and choose __Open__ *(or use the keyboard shortcut ⌘-O)*
* Navigate to the folder you chose earlier, select the __exercise-1-duel__ folder and click the __Open__ button

You should see an empty project window with a sequence of tips about keyboard shortcuts.

![Empty project](http://phiffer.org/scripting/week2/images/empty-project.jpg)

## Create a new file

* Go to the __File__ menu and choose __New File__ *(or use the keyboard shortcut ⌘-N)*
* Go to the __File__ menu and choose __Save__
* Give your empty file the name `duel1.txt` and save it into your `exercise-1-duel` folder

You should see a new entry for `duel1.txt` appear in the project sidebar.

![Empty file](http://phiffer.org/scripting/week2/images/empty-file.jpg)

## Copy from the page

* Select the dueling stick figures shown below
* Copy the text to your clipboard with the keyboard shortcut __⌘-C__

```
~O  O~
<|/\|>
 |\ |\
```

## Paste into your new file

* Go back to the Atom editor
* Paste the contents of your clipboard with the keyboard shortcut __⌘-V__
* Save your file with the keyboard shortcut __⌘-S__

You may notice a little blue dot disappear from the tab, indicating you no longer have unsaved changes.

![Duel text](http://phiffer.org/scripting/week2/images/duel-txt.jpg)

## Commit your change

Go to the GitHub Desktop app, it should have noticed your file.

* Type a short description of your change into the "Summary" text box next to your user icon (e.g., "Added dueling figures")
* Click the __Commit to master__ button

![Commit message](http://phiffer.org/scripting/week2/images/commit-message.jpg)

The amount of description you give to your commits effects how easily you can decipher your work later on. Try to be reasonably descriptive with your commit messages.

## Publish your commit

At this point you have a commit stored on your local computer, but it hasn't been uploaded to GitHub yet. By decoupling those two actions, `git` makes it much easier to work offline, when you may not be able to immediately send your changes to a central server.

* Click the __Publish__ button in the top right

![Publish commit](http://phiffer.org/scripting/week2/images/publish-commit.jpg)

## Check that your changes are on GitHub

* Go to [github.com](https://github.com/)
* Look for the box labeled "Your repositories" and click on `exercise-1-duel`
* Click on `duel1.txt` to confirm that your dueling stick figures are there

![GitHub duel text](http://phiffer.org/scripting/week2/images/github-duel-txt.jpg){.border}

## Create more copies

Go back to Atom editor, where you should still have `duel1.txt` open.

* Go to the __File__ menu and choose __Save As__
* Choose the name `duel2.txt` and click the __Save__ button
* Copy and paste this slightly different version of the dueling figures into your text editor:

```
~O  O~
<|--|>
/ \/ \
```

You should now see two files entries in the project sidebar: `duel1.txt` and `duel2.txt`. Notice that the second one is green, indicating that it's a new file.

* Repeat that process to save a third file called `duel3.txt` with one more iteration of the ASCII duel:

```
~O  O~
<|\/|>
 |\ |\
```

You should now have three items in your project sidebar. You can switch between them in succession to see a rudimentary animation.

## Commit your copies

Go back to the GitHub Desktop app.

* Click on the tab that says "2 Uncommitted Changes" and you should see your new files
* Add another commit message and click the __Commit to master__ button
* Now click on the __Sync__ button to upload your second commit to GitHub

If you check your repository on GitHub, you should now see all 3 files.

![Three files](http://phiffer.org/scripting/week2/images/three-files.jpg){.border}

## All done!

Congratulations, you've created your first GitHub repository. If you'd like to read more about how this all works, check out:

* [Try Git](https://try.github.io/)
* [GitHub Help](https://help.github.com/)
