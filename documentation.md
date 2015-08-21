# Documentation

##### For Rangitaki Version 1.0.0

This is the full documentation for Rangitaki 1.0. If you're new to Rangitaki I recommend you to read the Quick Starting Guide <!--TODO link--> first.

This documentation covers anything concerning usage, setup and structure. For information on how to create themes, how to use RCC, how to localize or how to contribute look in the documentations for these topics.
<!--TODO link-->

## Content

 1. Requirements
 
  1. Server
  
  2. Home Computer
  
  3. Personal Skills
 
 2. Setup
 
  1. Installation
  
  2. Configuration
 
 3. Usage
 
  1. Blog posts
  
  2. Blogs
  
  3. Media
 
 4. Structure
 
  1. /
 
  2. /articles/
  
  3. /blogs/
  
  4. /lang/
  
  5. /media/
  
  6. /rcc/
  
  7. /res/
  
  8. /themes/

## 1 Requirements

In this chapter I will outline the requirements of Rangitaki concerning your web server, your home computer and your personal skills. Since Rangitaki is built to be simple and easy, the following paragraphs won't be that long.

### 1.1 Web server

Rangitaki itself requires a **web server** like the Apache HTTP Server or nginx, with a **PHP** installation. (For the installation and configuration read the manual of your distribution). You don't need to install any kind of database programs on your server.

It is recommended to use (or enable) SSH access to the server, because the Rangitaki project may provides software in the future that will access your web server over SSH.

### 1.2 Home computer

You don't need any special software on your home computer. Just a simple text editor for writing the blog posts is needed. It is recommended (but certainly not necessary) to use an editor with syntax highlighting for Markdown.

### 1.3 Personal skills

Since Rangitaki tries to be as simple as possible, you don't need much skills. You should be able to upload files and directories to your server and a few basics in Markdown, which is the Markup language in which the blog posts are written. If you don't know any Markdown yet, it is very easy to learn and this can be done at <!--TODO Link-->.

## 2 Setup

If you're new to Rangitaki, I recommend you to start with the quick starting guide <!--TODO link--> and come back to this page if you need more information.

### 2.1 Installation

There are two ways of installing Rangitaki:

The first one is to ownload the latest release of Rangitaki from GitHub <!--TODO link-->, unpack it and upload it to your server. 

You can also download Rangitaki directly to your server using `curl` or `wget` and unpack it right there.

You can saftly delete ever file with the name example, but I recommend you to look at these files to see how things are done in Rangitaki.

### 2.2 Configuration

Configuring Rangitaki is quite easy and done by editing one file: the `config.php` in the source of your Rangitaki installation.

In the following lines I will describe, what you can do with each option. Mind ALWAYS the semicolor at the and and the marks around the value.

`$blogtitle = "Divide through zero";`

This is the name of your blog. Set it to something you thing is right. Rangitaki takes this value at every call, so you don't have to re-generate something, if you change it.

`$blogauthor = "Big Zero";`

Set here you're name. This will not shown on the Rangitaki blog itself, but I is shown if you share the blog or a article in a social network.

`$blogdescription = "Some wrong facts about the world";`

Set here a short description of the blog. This value is also only used for sharing.

`$bloghome = "yes";`

Set here *yes* if your blog is a subdirectory of a website and *no* if it isn't.

`$bloghomeurl = "/dev/null";`

This is the URL to your main page. Only used if `$bloghome` is set to *yes*

`$bloghomename = "Deep and Dark...";`

This is the name of your main page as shown in the Rangitaki navigation drawer. Only used if `$bloghome` is set to *yes*

`$blogmainname = "The complete Pi!";`

The name of your main blog. By default this is empty and the `$blogtitle` is used for that. But in some cases it comes in quite handy.

`$blogintro = "yes";`

Set to *no* if you don't want to show any blog intro. Read 3.2 Blogs for more information.

`$blogdisqus = "thelostkeyboard";`

Set here the Disqus ID for this site if you have one. Leave empty to disable.

`$sharefab = "yes";`

This disables (*no*) and enables (*yes*) the share floating action button in the bottom right corner. Enabled by default.

`$bloganalytics = "TrAcK00mE";`

Set here the ID of your Google Analytics property. Leave empty to disable it.

`$blogfooter = "This is the end!";`

Set here a text for your footer. You can also write some PHP here if you know any.

`$rcc = "no";`

Disables / Enables the RCC. Read the RCC documentation for more. <!--TODO link-->

`$nav_drawer = "yes";`

With *no* you can disable the navigation drawer on the left side.

`$theme = "material-light";`

Set here the name of the theme you wan't to use. All themes are in the folder `themes`

`$language = "js";`

Set here the language of your blog. All languages are in the folder `lang`. You can easily translate it to your own language since there aren't many strings. Read also the localization doc. <!--TODO link-->

`$favicon = "http://trash.your.icon/facicon.png";`

Set here the weburl to your favicon.

## 3 Usage

In the following paragraphs I describe the details of using Rangitaki.
 
### 3.1 Blog posts

Every post is saved in the directory /articles/name-of-the-blog/YYYY-MM-DD-hh-mm-title.md

You can drop the hh-mm if you don't write more than one blog post a day. Rangitaki will use this timestamp to sort your blogpost and to show them chronologically in your blog. The title doesn't need to be the complete title of your blog post.

The blog posts itself consists of two parts. The Rangitaki keywords and the main content

**Rangitaki Keywords**

There are four Rangitaki keywords you can set for everey post. Each one of them is not necessary, but the most should be set.

A keyword starts with a `%` followed by the keyword (all uppercase letters), a space, a `=`, another space and the value. Mind also the order of the keywords. It cannot changed.

`%TITLE = How to control the whole world. Pt. 1`

The first keyword is the title of your posts.

`%DATE = 6 June 666 06:06`

The second one is the date. The format is completly free to choose.

`%AUTHER = The Devil`

The author of the blog post.

`%TAGS = world, evil`

The tags of a post. Seperated by a colon and a space.

Leave then on line emtpy and start writing your blog post. For formatting the text, use Markdown.
  
### 3.2 Blogs

Rangitaki supports multiple subblogs in one blog. The *main* blog is also just a subblog, but it is used as the default one.

To create a blog, just create a directory in articles with the name of your blog and a file with the same name and an *.md* extension in `/blogs`.

The `blogname.md` is the so called blogfile. In this file you have to set one keyword. And in Rangitaki 1.0.0 there is also just one keyword available.

`%TITLE = Power off`

The keyword is set exactly the same way as in the blog posts.

Another special thing that Rangitaki has are blog intros. Text that are at the beginning a blog, before th first blog posts. The blog intros support also Markdown and you can write them in your blogfile. Leave one line empty after the *%TITLE* keyword and start writing your blog intro.

### 3.3 Media

How you save your media files is up to you. Rangitaki has a `/media` directory to store that stuff if you want. There is only one important thing: If you include some media in your blog post with relative paths, then the paths begin not in your articles directory but in the Rangitaki source directory.

## 4 Structure

Here I will explain the structur of the Rangitaki blogging engine. The root directory is the root directory of the blog, not of your computer.

### 4.1 /

In the root directory of Rangitaki you will find the following files:

 - config.php
   
   The file where the settings for your Rangitaki blog are stored. All the options are discussed earlier.
   
 - index.php
   
   The file which creates your blog, if you visit it in the web.
   
 - LICENSE
 
   The license of Rangitaki
   
 - README.md
 
   A short readme

### 4.2 /articles/

In the articles directory are the directory for you subblogs (at least one, the main blog). These directories are filled with your blog posts.
  
### 4.3 /blogs/

In this directory all your blog files are listed. At least you need the *main.md*.
  
### 4.4 /lang/

Here you can find the language files that Rangitaki uses to localize some strings. Read more in the localization documentation. <!--TODO link-->
  
### 4.5 /media/

A directory where you can store your images, videos or other stuff.

### 4.6 /rcc/

The directory of the Rangitaki Control Center (RCC). Read the RCC documentation for more information. <!--TODO link-->
  
### 4.7 /res/

Here are some important files for the blog like images (e.g. the share buttons), the base style sheet, some JavaScripts and a few PHP files.

### 4.8 /themes/

This is the directory where the Rangitaki themes are stored. If you found another Rangitaki theme online, save it into this directory and choose it in your config.php.
