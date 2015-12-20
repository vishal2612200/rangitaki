<?php
/**
 * PHP Version 5.6
 *
 * Rangitaki Project
 * This is the configuration file. You can configure here all necessary
 * (and possible) options without editing the index.php file.
 * Every line has an description about what you can change here.
 * Don't delete any strings. You can set your value after the '=' sign
 * and between the apostrophes.
 *
 * Make sure that every line ends with an semicolon (';').
 *
 * @category Config
 * @package  Rbe
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */

// Blog Title / Set here an individual title of yourblog by replacing
// Rangitaki Blog with it.
$blogtitle = 'Example Blog';

// Blog Author - Set here your name
$blogauthor = 'John';

// Blog description
$blogdescription = 'A short description of your blog';

// Home - set yes if you want to link to your homepage and no if not
$bloghome = 'yes';

// Home URL - Set here the url to your main page. Either as a path (e.g. '../')
// or as an url (e.g. 'http://github.com')
$bloghomeurl = '../';

// Home name - Set here an individual name for your main page
$bloghomename = 'Home';

// Main Blog name -> Set a specific name for your main blog
// This value is empty by default
$blogmainname = '';

// Intro - set yes if you have a blog intro and no if you don't have one
$blogintro = 'yes';

// Disqus - Provide here your Disqus shortname. Leave empty if you don't
// want to use it.
$blogdisqus = 'rangitaki';

// Share FAB - this enables or disables the share button
$sharefab = 'yes';

// Google Analytics - Provide here your Google Analytics Tracking-ID. Leave
// empty if you don't want to use it.
$bloganalytics = '';

// Footer - set here the text for your footer (e.g. a copyright info).  You can
// replace the whole text after the '=' with your own one.
$blogfooter = 'Rangitaki ' . date("Y") .
    ' <a href="https://github.com/mmk2410/Rangitaki" target="blank">
    github.com/mmk2410/Rangitaki</a>';

// This enables the optional rangitaki control center. Please read the
// documentation before you enable it.
$rcc = 'yes';

// Here you can disable and enable the navigation menu. Usefull if you have
// no subblogs and no home directory
$nav_drawer = 'yes';

// Set here the name of your theme. Read the documentation for more themes
$theme = 'material-light';

// Set here your language. The file must exist in the lang directory
$language = "en";

// pagination: how many articles should be on one page
// set to 0 to disable it
$pagination = 0;

// Favicon - Set here the path to your favicon
$favicon = "http://example.com/res/img/favicon.png";
