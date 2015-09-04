# Scripting template

A basic PHP/Markdown website generated from a GitHub repository. Kind of in the spirit of [GitHub Pages](https://pages.github.com/), except you host the files on your own server.

1. Fork this repo
2. Add your own Markdown files (save them with .md file extensions)
3. Edit `index.php`  
    * Set `$base_path` to match the URL path where the site is hosted (e.g., `/` or `/my-project`)
    * Set the default `$title`
4. Edit `header.md` and `footer.md`
5. Edit `styles.css` as desired
6. Clone the repo onto your web server

## URLs

Let's say you clone to a folder hosted at `http://example.horse/website`.

1. `README.md` is the homepage, available from `http://example.horse/website/`
2. A file called `foo.md` is available from `http://example.horse/website/foo`
3. `subdirectory/bar.md` is `http://example.horse/website/subdirectory/bar`
4. `baz.html` is http://example.horse/website/baz

## Auto-update

You can set up your website to update automatically whenever you push new commits up to GitHub.

1. Go to your repository's settings page:  
    `https://github.com/[username]/[repo]/settings`
2. Click on the __Webhooks & services__ tab
3. Click the __Add webhook__ button
4. Enter the URL for your website
5. Switch the Content type to "application/x-www-form-urlencoded"
6. You don't need a secret, and you only need "just the push event."
7. Check the __Active__ checkbox
8. Click the __Add webhook__ button
