# Exercise: The duel

In this exercise we are going to create a tiny ASCII art duel. Mostly this will serve as a chance to learn how to use GitHub to save things.

## Create a new repository

Before we begin to work on our ASCII art duel, we need to create a place for it to live on GitHub. Go to [github.com/new](https://github.com/new) to create a new repository. You may need to login if you haven't already.

* Repository name: `exercise-1-duel`
* Leave everything else as-is, and click the green __Create repository__ button

![Create a new repository](http://phiffer.org/scripting/week2/images/create-repository.jpg){.border}

You can ignore the instructions on the resulting page.

## Sign into GitHub Desktop

*Note: the next two parts assume you are using Mac OS X. If you're using a different operating system (or if your Mac doesn't support GitHub Desktop), skip this section and the next one, and follow GitHub's instructions about [how to clone your repository from the command line](https://help.github.com/articles/cloning-a-repository/).*

* Open GitHub for desktop
* Skip the setup (close the first window that appears)
* Go to the __GitHub Desktop__ menu and choose __Preferences__
* Click on the __Accounts__ tab
* Login with your GitHub username and password

![Sign into GitHub](http://phiffer.org/scripting/week2/images/sign-in.jpg)

## Clone your repository

* Go to the __File__ menu and choose __Clone repository__
* Select your repository from the list and click the __Clone exercise-1-duel__ button
* Choose a folder to save your work, just be sure you can find it later

![Clone your repository](http://phiffer.org/scripting/week2/images/clone-repository.jpg)

## Set up a new Atom project

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

* Type a short description of your change into the "Summary" text box next to your user icon (e.g., "Added dueling figures"), including descriptive commit messages is a good habit
* Click the __Commit to master__ button

![Commit message](http://phiffer.org/scripting/week2/images/commit-message.jpg)

## Publish your commit

At this point you have a commit stored on your local computer, but it hasn't been uploaded to GitHub yet. By decoupling those two actions, it makes it much easier to work offline, when you may not be able to immediately send your changes to a central server.

* Click the __Publish__ button in the top right

![Publish commit](http://phiffer.org/scripting/week2/images/publish-commit.jpg)

## Check that your changes are on GitHub

* Go to [github.com](https://github.com/)
* Look for the box labeled "Your repositories" and click on `exercise-1-duel`
* Click on `duel1.txt` to confirm that your dueling stick figures are there

![GitHub duel text](http://phiffer.org/scripting/week2/images/github-duel-txt.jpg)
