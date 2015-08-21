# Quick start Guide

##### For Rangitaki version 1.0

This guide shows you how to setup Rangitaki and it teaches you the basic use. After this guide you're ready to use Rangitaki as your blogging engine. Since this is a quick starting guide I won't explain every single option. Please read the full documentation <!--TODO Link to full documentation--> for more information.

To fully customize your Rangitaki installation read also the localization guide and the theming guide. <!--TODO links to both -->

For more professional blogging (like online blog post upload) read the RCC documentation. <!--TODO link -->

## Content
 1. Requirements

 2. Download

  1. Download

  2. Extract

 3. Setup

  1. Configuration

  2. Files and Directories

 4. Writing blog posts

  1. Tags

  2. Markdown

 5. Publishing


## 1. Requirements

#### Software

Rangitaki needs just a **Web Server** like the Apache HTTP Server or nginx and a **PHP** installation. You *don't need a MySQL (or any other database) installation*.

To test if you're server has a PHP installation, create a file name `info.php` and copy the follwing code into it, upload the file to your web directory and access it through a browser.

```
<?php phpinfo(); ?>
```

If you're seeing an white, empty page you have no PHP installation. Otherwise you have one and you can get many information about this from this page.

Furthermore you need a good text editor for editing the configuration files a nd writing blog posts.. Either on your private computer, if you configure your Rangitaki installation at home, or on your server.

#### Skills

You must know how to upload files and directories to your server and how to use a text editor. That's all.

## 2. Download

### 1. Download

Download the current version of Rangitaki either from [here](http://marcel-kapfer.de/rangitaki) <!--TODO add link --> or from the [GitHub releases page](https://github.com/mmk2410/Rangitaki/releases). I recommend you to download a release version and not to clone the project from GitHub (at least not for daily use), because of possible security and instability.

### 2. Extract

#### Linux

If you got a `.tar.gz` file:

Fire up a terminal and run this:

```
tar -xvzf rangitaki.tar.gz
```

If you got a `.zip` file:

Fire up a terminal and run this:

```
unzip rangitaki.zip
```

#### Mac

Just double click the archive.

#### Windows

If you got a `.zip` file:

Just right click that archive and click extract.

If you got a `.tar.gz` file:

Download and install [7-zip](http://www.7-zip.org/).

Right click the archive. 7-Zip > Extract here

## 3. Setup

The setup of Rangitaki is as easy as downloading it.

Again, I will only explain a few options here. For more, read the full documentation <!--TODO link to full documentation-->


### 1. Configuration

There one configuration file for Rangitaki. It is located at the root of the extracted Rangitaki folder and has the name `config.php`. Open it with a text editor of your choice.

The different options in the file follow this structure:

```
// Comment describing the following option
$option = 'some text or yes or no. mind the marks and the semicolon';
```

Don't delete the marks or the semicolon. Otherwise your Rangitaki installation will not work! Also don't delete the `<?php` at the beginning of the file.

The important and necessary options for your blog are:

#### $blogtitle

Set here the title of your blog. This name will appear in the blog header and is also the page title.

#### $blogauthor

Set here your name - or the name of the person who writes the blog. This setting is mainly used if the blog is shared in social networks. The author of blog posts can be set directly in the blog post.

#### $blogdescription

Write here a short blog description. This description will appear if the blog is shared in a social network.

#### $bloghome

Set 'yes' if you have a main page and the blog is just a subpage. If the blog is the main page, then set 'no'.

#### $bloghomeurl

Only necessary if $bloghome is set to 'yes'.

Set here the path to your main page. Either relative (e.g. `../`) or absolute (e.g. `/www/`) or as a link (e.g `http://marcel-kapfer.de/rangitaki`).

#### $blogintro

If set to 'yes', the text of the blog markdown file is shown at the beginning of the blog. If you don't want this, then change it to 'no'.

#### $blogfooter

Set here your own personal footer text. It is shown at the bottom of every page.

#### $language

Set here the language of your blog (e.g. 'en', 'de', ...). If your language is available, it will be used, otherwise English is used. You can also translate it Rangitaki into your language, which is quite simple and quickly done. Read the localization guide for more <!--TODO link to localization guide-->.

#### $favicon

Set here the URL to your favicon. Not a relative path or a absolute one, but the URL (e.g. 'http://example.com/favicon.png').


### 2. Files and Directories

Here a few words about some files and directories in Rangitaki. All directories and files are covered in the full documentation <!--TODO link to full documentation -->

#### /articles

This is the directory where the blog post for the different blogs are stored. There are already a few example directories, which you can delete if you don't need them.

#### /articles/blog (e.g. /articles/main)

The directory where the articles for that blog are stored. You have at least one directory name 'main' where the markdown files for your main blog are stored.

There are already a few example blog posts. You can look at them to learn how Rangitaki blog posts are written or you can simply delete them.

#### /blogs

The files for your different blogs are stored here. You can have a look at them to learn how to create a new subblog or simply delete them, but **DON'T DELETE THE main.md!**

#### /media

This is a directory where you can store your used assets. You don't have to store them but it is recommended since it keeps the whole system organized.

**When you are including a image, video, whatever in your Markdown blog post you have to use a relative path based from the Rangitaki blog main directory, not from the directory of your Markdown file**

You can delete the example file.

#### config.php

This is the configuration file. I already explained that one.

## 4. Writing blog posts

Writing blog posts in Rangitaki is quite simple. The text is written in markdown and important information about blog posts are written with special tags.

### 1. Tags

In Rangitaki 1.0 there are four tags you can use. You don't have to use any tags.

Tags have to following structure:

```
%TAGNAME: Some text
```

#### %TITLE

Set here the title of your blog post.

#### %DATE

Set here the date of your blog post. You don't have to care about some format. Just set it like you want

#### %AUTHOR

Set here the name of the author of the blog post.

#### %TAGS

Set here some tags, that descripe the blog post.

There separated through a ', ' (mind the space).

### 2. Markdown

Writing the text itself is also very simple. The blogging engine supports Markdown and also GitHub flavored markdown <!--TODO links to both of them-->. But you can also just wite a blogpost and don't care about formatting.

## 5. Publishing

You are now done with the setup of the blog and you also wrote a first blog post. If you did this stuff directly on your server, visit this page with a web broswer and you see your Rangitaki blog.

If you did this on your private machine, then upload the content of the Rangitaki directory to your server.

You're done now! You're Rangitaki blog is running.

For more information, read the full documentation, the FAQ and the other documentations.

<!--TODO links-->
