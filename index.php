<!DOCTYPE HTML>
<!--
    Rangitaki
    GitHub: https://github.com/mmk2410/Rangitaki
    Web: https://marcel-kapfer.de/rangitaki
    Twitter: @Rangitaki
    Google+: +Rangitaki
-->
<!--
COPYRIGHT (c) 2015 mmk2410

MIT License
-->
<html>
<?php
/**
 * Rangitaki PHP Blogging engine
 * @category Blogging
 * @package Rbe
 * @author Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license MIT https://opensource.org/licenses/MIT
 * @link https://marcel-kapfer.de/rangitaki
 */
// Getting necessary php files
date_default_timezone_set('UTC');
require 'config.php'; // Config file (this must be the first line)
require './lang/' . $language . ".php"; // Language file
require_once 'res/php/Parsedown.php'; // The soul of the beast: Parsedown
require_once 'res/php/ArticleGenerator.php'; // The article generator
require_once './res/php/BlogListGenerator.php'; // and the blog list generator
// Getting some variables ($_GET and $_SERVER)
$getblog = filter_input(INPUT_GET, "blog"); // getting the blog variable
$getarticle = filter_input(INPUT_GET, "article"); // getting the article variable
$gettag = filter_input(INPUT_GET, "tag"); // getting the tag variable
$url = "http://" . filter_input(INPUT_SERVER, "HTTP_HOST") . filter_input(INPUT_SERVER, "REQUEST_URI"); // getting the url (used for sharing)

// Fetching necessary information about the current article
// Set blog to "main" if on main blog, else to $getblog. This variable is needed later
if ($getblog == "") {
    $blog = "main";
} else {
    $blog = $getblog;
}
$articlesdir = "./articles/$blog/"; // generate a variable with the articles directory
// Fetching the articles title
if (isset($getarticle)) {
    $articletitle = ArticleGenerator::getTitle($articlesdir, $getarticle . '.md');
}
// Make sure that the entry has a title, because main.md hasn't one
if (empty($blogmainname)) {
    $blogmaintitle = $blogtitle;
} else {
    $blogmaintitle = $blogmainname;
}
if (isset($getblog)) {
    $subblogtitle = BlogListGenerator::getName('./blogs/' . $getblog . '.md');
} else {
    $subblogtitle = $blogmaintitle;
}
// Generate title for the html head
if (isset($getarticle)) {
    $hd_subblog_title =  $articletitle . ' - ' . $subblogtitle;
} else {
    $hd_subblog_title = $subblogtitle;
}
?>

<head>
    <meta charset="utf-8">
    <title><?php echo $hd_subblog_title; ?></title>
    <!--Metatags-->
    <meta name="author" content="<?php echo $blogauthor; // Setting the blog author ?>"/>
    <meta name="description" content="<?php echo $blogdescription; // the blog description ?>"/>
    <!-- Meta tag for responsive ui-->
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <!-- OpenGraph meta tags -->
    <meta property="og:title" content="<?php echo $hd_subblog_title; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php echo $url; ?>"/>
    <meta property="og:image" content="<?php echo $favicon; ?>"/>
    <meta property="og:description" content="<?php echo $blogdescription; ?>"/>
    <meta property="og:locale:alternate" content="<?php echo $lang; ?>"/>
    <!-- Twitter meta tags -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="<?php echo $twitter; ?>"/>
    <meta name="twitter:title" content="<?php echo $hd_subblog_title; ?>"/>
    <meta name="twitter:description" content="<?php echo $blogdescription; ?>"/>
    <meta name="twitter:image" content="<?php echo $favicon; ?>"/>
    <meta name="twitter:url" content="<?php echo $url; ?>"/>
    <!--CSS files-->
    <link rel="stylesheet" type="text/css" href="res/css/rangitaki.css"/>
    <link rel="stylesheet" href="./res/css/github-gist.css"> <!-- stylesheet for code highlighting-->
    <link rel="stylesheet" type="text/css" href="themes/<?php echo $theme; // getting the theme stylesheet?>.css"/>
    <?php
    // Checking if the drawer is enabled
    if ($nav_drawer == 'no') {
        // Loading additional stylesheet for disabling the drawer?>
        <link rel="stylesheet" type="text/css" href="res/css/no-nav.css"/>
        <?php
    }
    ?>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,500,700,300,400italic,100,100italic,900' rel='stylesheet'
          type='text/css'> <!--Font-->
    <!--Favicons-->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $favicon; ?>"/>
    <link rel="apple-touch-icon-precomposed" href="<?php echo $favicon; ?>">
    <!-- JavaScript Pt. 1: HightlightJS (get and load): Code highlighting-->
    <script src="./res/js/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</head>

<body>
<?php
// Checking if the navigation drawer is enabled. If not -> skip it
if ($nav_drawer == "yes") {
    ?>
    <div class="overlay"></div> <!-- Darken the background when fading the drawer in. See also the JS file-->
    <div class="nav">
        <div class="nav-close">
            <img src="./res/img/close-dark.svg" class="nav-close-img" alt="Close"/>
        </div>
        <div class="divider"></div>
        <?php
        $blogs = scandir("./blogs/"); // Getting everything from the blog directory
        if (!isset($getarticle) && !isset($gettag) && sizeof($blogs) > 3) { // Checking if not in article or tag view and if there are more the one blog. The 3 is for these three array entries: 'main.md', '.', '..'
            echo "<section>";
            echo "<div class='nav-item-static'>" . $BLOGLANG['Blogs on'] . " $blogtitle:</div>"; // 1. Set localized string 2. Set blogtitle
            foreach ($blogs as $navblog) { // iterating through the blogs/ directory
                if (strlen($navblog) >= 3 && substr($navblog, -3) == ".md") { // check if filename is larger than three chars and if the file ends with ".md"
                    if ($getblog == "") { // Run when on main blog
                        if ($navblog != "main.md") { // excluding main blog
                            BlogListGenerator::listBlog("./blogs/", $navblog, $blogtitle); // creating navigation item
                        }
                    } else {
                        if ($getblog . ".md" != $navblog) { // Check if $blog is current blog -> this blog will be excluded
                            BlogListGenerator::listBlog("./blogs/", $navblog, $blogmaintitle); // creating navigation item
                        }
                    }
                }
            }
            echo "</section>";
        } elseif (isset($getarticle) || isset($gettag)) { // If viewing a blog or a tag
            ?>
            <a class="nav-item" onclick="goBack()">Go back</a> <!-- Set a back item instead of the blogs. -->
            <?php
        }
        if ($bloghome == "yes") { // If a blog home is existend
            ?>
            <div class="divider"></div>
            <a class="nav-item" href="<?php echo $bloghomeurl; ?>"><?php echo $bloghomename; ?></a>
            <?php
        }
        ?>
    </div> <!-- End of the navigation drawer-->
    <?php
} // Endif from line 97; Yes, I really should think about alternative syntax...

?>
<div class="main"> <!-- Main page with content -->
    <div class="header">
        <!-- Action Bar, but since there isn't much action I call it header. One day a search feature would be nice...-->
        <img src="./res/img/menu.svg" class="nav-img"/> <!-- Ham,ham,hamburger-->
        <!-- Blog title with subblog title and links to each one-->
        <nobr><span class="title"><a href="./"><?php echo $blogtitle; ?><!-- link to main blog-->
                    <?php
                    if (empty($getblog)) { // if not on a subblog
                        if (!empty($blogmainname)) {
                            echo "›" . $blogmainname; // If you see a › (square) here : This is not a bug, but a missing sign in your font
                        }
                    } else { // On subblog: set also a link to the subblog
                    ?>
                </a>
                            › <a href="<?php echo "./?blog=$getblog" ?>">
                    <?php
                    echo BlogListGenerator::getName("./blogs/$getblog.md"); // get the blog name
                    }
                    ?>
                </a>
                    </span>
        </nobr>
        <div class="fadeout"></div>
        <!-- if the blog name is to long (especially on mobile devices), a fadeout fades the test out at the end of the header-->
    </div>
    <?php
    // Blog Intro text
    if (file_exists("blogs/$blog.md") && $getarticle == "" && $blogintro == "yes" && $gettag == "") { // only shown if not in article or tag view and if the blogintro is enabled
        $file = file_get_contents("blogs/$blog.md"); // get content of the blog file
        $file = $file . "\n"; // add a line break. necessary if the editor didn't make one while saving
        $file = substr($file, strpos($file, "\n")); // basically removing the first line, which contains the blog title
        if (strlen($file) > 3) { // if there is no content, don't show the intro
            ?>
            <section class="card" id="intro">
                <div class="articletext">
                    <?php // generate the html text from the markdown file
                    $intro = Parsedown::instance()
                        ->setBreaksEnabled(true)// with linebreaks
                        ->text($file);
                    echo $intro; // PRINTS THE SH****
                    ?>
                </div>
            </section>
            <?php
        }
    }
    // TAG VIEW
    if (isset($gettag)) { // if there's a tag -> tag view
        $articles = scandir($articlesdir, 1); // save the content of the directory in the articles variable
        foreach ($articles as $article) { // iterate through all articles
            $tags = ArticleGenerator::getTags($articlesdir, $article); // get the article tags
            if (in_array($gettag, $tags)) { // if the article has the requested tag
                if (strlen($article) >= 3 && substr($article, -3) == ".md") { // check if the file is a article file
                    ArticleGenerator::newArticle($articlesdir, $article, $getblog); // generate the article
                }
            }
        }
    } elseif ($getarticle == "") { // NORMAL VIEW if there's no article request -> normal view
        $articles = scandir($articlesdir, 1); // save the content of the directory in the articles variable
        foreach ($articles as $article) { // iterate through this variable
            if (strlen($article) >= 3 && substr($article, -3) == ".md") { // check if the file is a article file
                ArticleGenerator::newArticle($articlesdir, $article, $getblog); // generate the article
            }
        }
    } elseif (isset($getarticle)) { // ARTICLE VIEW
        ArticleGenerator::newArticle($articlesdir, $getarticle . ".md", $getblog); // generate the requested article
        include './res/php/Disqus.php'; // include disques
    } else { // SOMETHING STRANGE: THIS SHOULDN'T HAPPEN
        echo "Some error occured, please go back.";
    }
    ?>
    <div class="footer">
        <?php echo $blogfooter; //print the blog footer?>
    </div>
    <?php
    // show the fab if it's enabled
    if ($sharefab == "yes") {
        ?>
        <div class="fabmenu">
            <div class="subfab"><!--Email subfab-->
                <a href='mailto:?subject=<?php echo $blogtitle; ?>&body=<?php echo $BLOGLANG['Check out this blog']; ?>: <?php echo $url; ?>'
                   target="blank">
                    <img src="./res/img/email.svg" class="subfab-img"/>
                </a>
            </div>
            <div class="subfab"><!--twitter subfav-->
                <a href='https://twitter.com/intent/tweet?text=<?php echo $BLOGLANG['Check out']; ?>: <?php echo $url; ?>&original_referer='
                   target="blank">
                    <img src="./res/img/twitter.svg" class="subfab-img"/>
                </a>
            </div>
            <div class="subfab"><!--gplus subfab-->
                <a href='https://plus.google.com/share?url=<?php echo $url; ?>&hl=en-US' target="blank">
                    <img src="./res/img/gplus.svg" class="subfab-img"/>
                </a>
            </div>
            <div class="subfab"><!--facebook subfab-->
                <a href='https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&t=<?php echo "echo $blogtitle" ?>'
                   target="blank">
                    <img src="./res/img/facebook.svg" class="subfab-img"/>
                </a>
            </div>
            <div class="fab"><!-- share fab-->
                <img src="./res/img/share.svg" class="fab-img" alt="Share"/>
            </div>
        </div>
        <?php
    }
    ?>
</div>
<script src="./res/js/jquery-2.1.4.min.js"></script> <!-- include jquery-->
<script src="./res/js/app.js"></script> <!--include main javascript-->
<!-- JS extension support -->
<?php
$extensions = scandir('./extensions');
foreach ($extensions as $extension) {
    if (substr($extension, -3) == ".js") {
        echo "<script src='./extensions/$extension'></script>";
    }
}
?>
<?php
require './res/php/GoogleAnalytics.php'; // include google analytics
?>
</body>
</html>
