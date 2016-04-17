# Rangitaki PHP blogging engine

Rangitaki is a simple to use and easy to configure blogging engine, written in PHP and it has absolutely no database dependencies.

Tested with PHP version 5.5 until 7.0.

![Rangitaki](https://marcel-kapfer.de/blog/media/with-name.png)

[Website](https://marcel-kapfer.de/rangitaki)

[About](https://marcel-kapfer.de/rangitaki/about)

[Documentation](https://marcel-kapfer.de/rangitaki/docs)

[Quick Starting Guide](https://marcel-kapfer.de/rangitaki/docs/quick)

## What is it?

My goal for Rangitaki was (and still is) to create a blogging engine without database dependencies (so you don't have to create database and tables and all that stuff) which is extremely easy and fast to setup and to learn. Rangitaki doesn't require any knowledge concerning PHP, JavaScript, HTML or CSS. You just need to know, how to upload something to your web server. There is also no need to compile anything, you just have to fill out twelve setting properties and then you can start writing your articles.

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
 - Easy localization (just a few strings)
 - Custom footer
 - Navigation drawer (can be disabled)
 - Tags
 - Set author and date
 - Mobile-first
 - JavaScript Extension Support
 - Pagination support
 - Atom feed generation
 - Rangitaki Control Center (RCC; optional, read the [RCC Documentation](https://marcel-kapfer.de/rangitaki/docs/rcc))
   - Have a look under 'What is that RCC?' in this readme

## Did you say 'themes'?

Yes. Rangitaki has a theme support which makes it easy to customize your blog concerning design.

[Read the theme guide](https://marcel-kapfer.de/rangitaki/docs/themes)

## What is that RCC?

**This is disabled by default. Do not enable it without carefully reading the RCC documentation.**

It has the following features:
 - Post upload
 - Post deleting
 - Post editing
 - Media upload
 - Atom feed generation

[Read the RCC documentation](https://marcel-kapfer.de/rangitaki/docs/rcc)

## Where can I see an example?

 - Official Rangitaki blog [marcel-kapfer.de/rangitaki/blog](https://marcel-kapfer.de/rangitaki/blog)

 - My personal blog
 [marcel-kapfer.de/blog](https://marcel-kapfer.de/blog)

Would you like to see your Rangitaki blog here? Write me a message at [marcelmichaelkapfer@yahoo.co.nz](mailto:marcelmichaelkapfer@yahoo.co.nz)

## Used Libraries

 - For converting the Markdown blog articles into HTML code Rangitaki uses  [Parsedown](http://parsedown.org).
 - For creating the atom feeds Rangitaki uses [picoFeed](https://github.com/fguillot/picoFeed)

## Contributing

## Issues, Requests, etc.

For bug reports, feature requests and all other stuff use
[phab.mmk2410.org/maniphest](https://phab.mmk2410.org/maniphest).

## Code

1. Fork it
2. Create your feature branch (`git checkout -b my-new-feature`)
3. Commit your changes (`git commit -am 'Add some feature'`)
4. Push to the branch (`git push origin my-new-feature`)
5. Create New Pull Request

Read also the [contributing documentation](https://marcel-kapfer.de/rangitaki/docs/contrib)

## Social

You can follow my personal Twitter and Google+ account to receive news about the Rangitaki blogging engine.

 - [Twitter @mmk2410](https://twitter.com/mmk2410)
 - [Google+ +MarcelKapfer](https://plus.google.com/+MarcelMichaelKapfer/posts)
