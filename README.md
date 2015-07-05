# Rangitaki PHP blogging engine

Rangitaki is a simple to use and easy to configure blogging engine, written in PHP and it has absolutely no database dependencies.

##Important - Please read

Right now there are two versions in development. The series 0.2 and everything higher. Version 0.2 is ready for production while everything higher are development releases and not ready for productive use. I recommend you to use the latest Version of the 0.2 series which you can find in the branch "Series-0.2" or wait until 1.0 is release, which will be at the end of July. The latest version is 0.2.2 which is available in the releases section. This readme is for the version >= 0.3.

Read also this [blog article](https://marcel-kapfer.de/rangitaki/blog/?article=2015-03-29-21-34-About-the-Future-of-pBlog) which explains the reasons behind this step.

## What is it?

My goal for Rangitaki was (and still is) to create a blogging engine without database dependencies (so you don't have to create database and tables and all that stuff) which is extremely easy and fast to setup and to learn. Rangitaki doesn't require any knowledge concerning PHP, JavaScript, HTML or CSS. You just need to know, how to upload something to your web server. There is also no need to compile anything, you just have to fill out twelve setting properties and then you can start writing your articles.

For version 1.0 I will provide a documentation and a quick-start guide.

## So, what can it do?

 - Post writing in Markdown with a few keywords for the title, tags, date and the author (all optional)
 - Multiple blogs
 - A Subpages for each article with a comment box (Disqus; can be disabled)
 - Share buttons (FAB; can be disabled)
 - Disqus integration (can be disabled)
 - Fast and easy configuration
 - Google Analytics (optional)
 - Twitter and OpenGraph meta tags
 - Different themes
 - Easy localization (just 3 (!) strings)
 - Custom footer
 - Navigation drawer (can be disabled)
 - Tags
 - Set author and date
 - Mobile-first
 - Rangitaki Control Center (RCC; optional, requires linux know-how, do not enable this unless you know what your doing)
   - Online post upload
   - More will come...

## Did you say 'themes'?

Yes. Rangitaki has a theme support which makes it easy to customize your blog concerning design. A documentation on how to create a theme will be available with version 1.0.

## What is that RCC?

**This is disabled by default. Do not enable it without carefully reading the RCC documentation.**

The RCC (Rangitaki Control Center) is still in development and features right now only a post upload. If you wanna use it you have to change file permissions manually on your server and also add some values to different text files.

A documentation for RCC will be available with the Rangitaki 1.0 release.

## Where can I see an example?

 - Official Rangitaki blog [marcel-kapfer.de/rangitaki/blog](https://marcel-kapfer.de/rangitaki/blog)

 - My personal blog
 [marcel-kapfer.de/blog](https://marcel-kapfer.de/blog)

Would you like to see your Rangitaki blog here? Write me a message at [marcelmichaelkapfer@yahoo.co.nz](mailto:marcelmichaelkapfer@yahoo.co.nz)

## What do you see in your crystal ball?

I'm thinking of releasing a Rangitaki PHP framework later this year, so you can simply build your own blog.

I also planning to port the engine and the framework into JavaScript. Which would be good for people without a PHP server and it would also be possible to create a Polymer element.

## Used Library

 - For converting the Markdown blog articles into HTML code I use  [Parsedown](http://parsedown.org)

## Contributing

### Code

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create New Pull Request

### Localization

Contribute localization files just like code. If you don't have a GitHub account you can also send me the files to [marcelmichaelkapfer@yahoo.co.nz](mailto:marcelmichaelkapfer@yahoo.co.nz)

### Team

If you want to join the Rangitaki "team" and are willing to invest some time into this project, then contact me over mail ([marcelmichaelkapfer@yahoo.co.nz](mailto:marcelmichaelkapfer@yahoo.co.nz)), Google+ ([+MarcelMichaelKapfer](https://plus.google.com/+MarcelMichaelKapfer) or [+Rangitaki](https://plus.google.com/b/101437210222436501912/101437210222436501912)) or Twitter ([@mmk2410](https://twitter.com/mmk2410) or [@rangitaki](https://twitter.com/rangitaki)) and we can talk about that.

## Social

 - [Twitter @rangitaki](https://twitter.com/rangitaki)
 - [Google+](https://plus.google.com/b/101437210222436501912/101437210222436501912/posts)

## Trello

 - [Trello Board](https://trello.com/b/7qb5I6EQ/rangitaki)
