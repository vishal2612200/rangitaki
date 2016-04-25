<!DOCTYPE HTML>
<!--
    Rangitaki Blogging Engine
    Code: https://gitlab.com/mmk2410/rangitaki
    Issus and Project Management: https://phab.mmk2410.org
    Web: https://marcel-kapfer.de/rangitaki
    2015 - 2016 Marcel Kapfer (mmk2410)
    License: MIT
-->
<html>
<?php
/**
 * PHP Version 5.6
 *
 * Rangitaki PHP Blogging engine
 *
 * @category Blogging
 * @package  Rbe
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT https://opensource.org/licenses/MIT
 * @link     https://marcel-kapfer.de/rangitaki
 */
// Getting necessary php files
date_default_timezone_set('UTC');
require __DIR__ . '/vendor/autoload.php'; // loading composer libs

require './res/php/Config.php';
use mmk2410\rbe\config\Config as Config;

$configParser = new Config('config.yaml', 'vendor/autoload.php');

$config = $configParser->getConfig();

require './lang/' . $config["language"] . ".php"; // Language file
require_once 'res/php/ArticleGenerator.php'; // The article generator
require_once './res/php/BlogListGenerator.php'; // and the blog list generator

// Getting some variables ($_GET and $_SERVER)
$getblog = filter_input(INPUT_GET, "blog"); // get the blog variable
$getarticle = filter_input(INPUT_GET, "article"); // get the article variable
$gettag = filter_input(INPUT_GET, "tag"); // getting the tag variable
$url = "http://" . filter_input(INPUT_SERVER, "HTTP_HOST") .
    filter_input(INPUT_SERVER, "REQUEST_URI"); // get the url (used for sharing)
$pagenumber = filter_input(INPUT_GET, "page"); // get the pagenumber

// Pagination algorithm
if ($config["design"]["pagination"] == 0) {
    $config["design"]["pagination"] = false;
} else {
    // pag_max: the newest post to show on a page
    $pag_max = $config["design"]["pagination"] * ( $pagenumber + 1 );
    // pag_min: the oldest post to show on a page
    $pag_min = $pag_max - $config["design"]["pagination"];
    if ($pagenumber > 0) {
        // Disable the blog intro if not on first page
        $config["blog"]["intro"] = "off";
    }
}

// Fetching necessary information about the current article
// Set blog to "main" if on main blog, else to $getblog.
// This variable is needed later
if ($getblog == "") {
    $blog = "main";
} else {
    $blog = $getblog;
}

// generate a variable with the articles directory
$articlesdir = "./articles/$blog/";
// Fetching the articles title
if (isset($getarticle)) {
    $articletitle
        = ArticleGenerator::getTitle($articlesdir, $getarticle . '.md');
}
// Make sure that the entry has a title, because main.md hasn't one
if (empty($config["blog"]["mainname"])) {
    $blogmaintitle = $config["blog"]["title"];
} else {
    $blogmaintitle = $config["blog"]["mainname"];
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

// url of the feed
$feedurl = $config["blog"]["url"] . "/feed/" . $blog . ".atom";

?>

<head>
    <meta charset="utf-8">
    <title><?php echo $config["blog"]["title"] . " » " .$hd_subblog_title; ?></title>
    <!--Metatags-->
    <meta name="author"
        content="<?php echo $config["blog"]["author"]; // Set the blog author ?>"/>
    <meta name="description"
        content="<?php echo $config["blog"]["description"]; // the blog description ?>"/>
    <!-- Meta tag for responsive ui-->
    <meta name='viewport'
        content='width=device-width, initial-scale=1.0,
            maximum-scale=1.0, user-scalable=0'/>
    <!-- OpenGraph meta tags -->
    <meta property="og:title" content="<?php echo $hd_subblog_title; ?>"/>
    <meta property="og:type" content="website"/>
    <meta property="og:url" content="<?php echo $url; ?>"/>
    <meta property="og:image" content="<?php echo $config['design']['favicon']; ?>"/>
    <meta property="og:description" content="<?php echo $config['blog']['description']; ?>"/>
    <meta property="og:locale:alternate" content="<?php echo $lang; ?>"/>
    <!-- Twitter meta tags -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:site" content="<?php echo $twitter; ?>"/>
    <meta name="twitter:title" content="<?php echo $hd_subblog_title; ?>"/>
    <meta name="twitter:description" content="<?php echo $config['blog']['description']; ?>"/>
    <meta name="twitter:image" content="<?php echo $config['design']['favicon']; ?>"/>
    <meta name="twitter:url" content="<?php echo $url; ?>"/>
    <!-- atom feed -->
    <?php
    if (file_exists("feed/" . $blog . ".atom")) {
    ?>
    <link rel='alternate' type='application/atom+xml' title='Atom 0.3' href=
    '<?php
        echo $feedurl;
    ?>'>
    <?php
    }
    ?>
    <!--CSS files-->
    <link rel="stylesheet" type="text/css" href="res/css/rangitaki.css"/>
    <!-- stylesheet for code highlighting-->
    <link rel="stylesheet" href="./res/css/github-gist.css">
    <link rel="stylesheet" type="text/css"
        href="themes/<?php echo $config['design']['theme']; // getting the theme stylesheet?>.css"/>
    <?php
    // Checking if the drawer is enabled
    if ($config["design"]["drawer"] != 'on') {
        // Loading additional stylesheet for disabling the drawer?>
        <link rel="stylesheet" type="text/css" href="res/css/no-nav.css"/>
        <?php
    }
    ?>
    <link href='//fonts.googleapis.com/css?family=Roboto:400,500,700,300,
        400italic,100,100italic,900' rel='stylesheet'
          type='text/css'> <!--Font-->
    <!--Favicons-->
    <link rel="shortcut icon" type="image/x-icon"
        href="<?php echo $config['design']['favicon']; ?>"/>
    <link rel="apple-touch-icon-precomposed" href="<?php echo $config['design']['favicon']; ?>">
    <!-- JavaScript Pt. 1: HightlightJS (get and load): Code highlighting-->
    <script src="./res/js/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</head>

<body>
<?php
// Checking if the navigation drawer is enabled. If not -> skip it
if ($config["design"]["drawer"] == "on") {
    ?>
    <!--
    Darken the background when fading the drawer in. See also the JS file
    -->
    <div class="overlay"></div>
    <div class="nav">
        <div class="nav-close">
            <img src="./res/img/close-dark.svg" class="nav-close-img"
                alt="Close"/>
        </div>
        <div class="divider"></div>
        <?php
        // Getting everything from the blog directory
        $blogs = scandir("./blogs/");
        // Checking if not in article or tag view and if there are more the one
        // blog. The 3 is for these three array entries: 'main.md', '.', '..'
        if (!isset($getarticle) && !isset($gettag) && sizeof($blogs) > 3) {
            echo "<section>";
            // 1. Set localized string 2. Set blogtitle
            echo "<div class='nav-item-static'>" .
                $BLOGLANG['Blogs on'] . $config["blog"]["title"] .
                ":</div>";
            // iterating through the blogs/ directory
            foreach ($blogs as $navblog) {
                // check if filename is larger than three chars and if the
                // file ends with ".md"
                if (strlen($navblog) >= 3 && substr($navblog, -3) == ".md") {
                    if ($getblog == "") { // Run when on main blog
                        if ($navblog != "main.md") { // excluding main blog
                            // creating navigation item
                            BlogListGenerator::listBlog(
                                "./blogs/", $navblog, $config["blog"]["title"]
                            );
                        }
                    } else {
                        // Check if $blog is current blog
                        // -> this blog will be excluded
                        if ($getblog . ".md" != $navblog) {
                            // creating navigation item
                            BlogListGenerator::listBlog(
                                "./blogs/", $navblog, $blogmaintitle
                            );
                        }
                    }
                }
            }
            echo "</section>";
        } elseif (isset($getarticle) || isset($gettag)) {
            // If viewing a blog or a tag
            ?>
            <!-- Set a back item instead of the blogs. -->
            <a class="nav-item" onclick="goBack()">Go back</a>
            <?php
        }
        if ($config["blog"]["home"] == "on") { // If a blog home is existend
            ?>
            <div class="divider"></div>
            <a class="nav-item" href="<?php echo $config['blog']['homeurl']; ?>">
                <?php echo $config['blog']['homename']; ?>
            </a>
            <?php
        }
        if (file_exists("feed/" . $blog . ".atom")) { ?>
            <div class="divider"></div>
            <a class="nav-item" href=
            '<?php
                echo $feedurl;
        ?>'>Feed</a><?php
        }
        ?>
    </div> <!-- End of the navigation drawer-->
    <?php
} // Endif from line 97; Yes, I really should think about alternative syntax...

?>
<div class="main"> <!-- Main page with content -->
    <div class="header">
        <!--
        Action Bar, but since there isn't much action I call it header.
        One day a search feature would be nice...
        -->
        <!-- Ham,ham,hamburger-->
        <img src="./res/img/menu.svg" class="nav-img"/>
        <!-- Blog title with subblog title and links to each one-->
        <!-- link to main blog-->
        <nobr><span class="title"><a href="./"><?php echo $config["blog"]["title"]; ?>
                    <?php
                    if (empty($getblog)) { // if not on a subblog
                        if (!empty($config['blog']['mainname'])) {
                            // If you see a › (square) here : This is not a bug,
                            // but a missing sign in your font
                            echo "›" . $config['blog']['mainname'];
                        }
                    } else { // On subblog: set also a link to the subblog
                    ?>
                </a>
                            › <a href="<?php echo "./?blog=$getblog" ?>">
                    <?php
                        // get the blog name
                        echo BlogListGenerator::getName("./blogs/$getblog.md");
                    }
                    ?>
                </a>
                    </span>
        </nobr>
        <div class="fadeout"></div>
        <!--
        if the blog name is to long (especially on mobile devices), a fadeout
        fades the text out at the end of the header
        -->
    </div>
    <?php
    // Blog Intro text
    if (file_exists("blogs/$blog.md")
        && $getarticle == ""
        && $config["blog"]["intro"] == "on"
        && $gettag == ""
    ) {
        // only shown if not in article or tag view
        // and if the blogintro is enabled
        // get content of the blog file
        $file = file_get_contents("blogs/$blog.md");
        // add a line break. necessary if the editor didn't make
        // one while saving
        $file = $file . "\n";
        // basically removing the first line, which contains the blog title
        $file = substr($file, strpos($file, "\n"));
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
        // save the content of the directory in the articles variable
        $articles = scandir($articlesdir, 1);
        // iterate through all articles
        foreach ($articles as $article) {
            // get the article tags
            $tags = ArticleGenerator::getTags($articlesdir, $article);
            // if the article has the requested tag
            if (in_array($gettag, $tags)) {
                // check if the file is a article file
                if (strlen($article) >= 3 && substr($article, -3) == ".md") {
                    // generate the article
                    ArticleGenerator::newArticle(
                        $articlesdir, $article, $getblog
                    );
                }
            }
        }
    } elseif ($getarticle == "") {
        // NORMAL VIEW if there's no article request -> normal view
        // save the content of the directory in the articles variable
        $articles = scandir($articlesdir, 1);
        // iterate through this variable
        $posts_amount = 0;
        foreach ($articles as $article) {
            // check if the file is a article file
            if (strlen($article) >= 3 && substr($article, -3) == ".md") {
                // generate the article
                if ($config["design"]["pagination"]) {
                    if ($posts_amount < $pag_max && $posts_amount >= $pag_min) {
                        ArticleGenerator::newArticle(
                            $articlesdir, $article, $getblog
                        );
                    }
                } else {
                    ArticleGenerator::newArticle(
                        $articlesdir, $article, $getblog
                    );
                }
            }
            $posts_amount++;
        }
        if ($config["design"]["pagination"]) {
            include './res/php/Pagination.php';
        }
    } elseif (isset($getarticle)) { // ARTICLE VIEW
        // generate the requested article
        ArticleGenerator::newArticle(
            $articlesdir, $getarticle . ".md", $getblog
        );
        include './res/php/Disqus.php'; // include disques
    } else { // SOMETHING STRANGE: THIS SHOULDN'T HAPPEN
        echo "Some error occured, please go back.";
    }
    ?>
    <div class="footer">
        <?php echo $config["blog"]["footer"]; //print the blog footer?>
    </div>
    <?php
    // show the fab if it's enabled
    if ($config["design"]["fab"] == "on") {
        ?>
        <div class="fabmenu">
            <div class="subfab"><!--Email subfab-->
                <a href='mailto:?subject=<?php
                    echo $config["blog"]["title"];
                ?>&body=<?php
                    echo $BLOGLANG['Check out this blog'];
                ?>: <?php
                    echo $url;
                ?>' target="blank">
                    <img src="./res/img/email.svg" class="subfab-img"/>
                </a>
            </div>
            <div class="subfab"><!--twitter subfav-->
                <a href='https://twitter.com/intent/tweet?text=<?php
                    echo $BLOGLANG['Check out'];
                ?>: <?php
                    echo $url;
                ?>&original_referer=' target="blank">
                    <img src="./res/img/twitter.svg" class="subfab-img"/>
                </a>
            </div>
            <div class="subfab"><!--gplus subfab-->
                <a href='https://plus.google.com/share?url=<?php
                    echo $url;
                ?>&hl=en-US' target="blank">
                    <img src="./res/img/gplus.svg" class="subfab-img"/>
                </a>
            </div>
            <div class="subfab"><!--facebook subfab-->
                <a href='https://www.facebook.com/sharer/sharer.php?u=<?php
                    echo $url;
                ?>&t=<?php
                    echo "echo " . $config["blog"]["title"];
                ?>' target="blank">
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
    if(file_exists("./extensions")) {
        $extensions = scandir('./extensions');
        foreach ($extensions as $extension) {
            if (substr($extension, -3) == ".js") {
                echo "<script src='./extensions/$extension'></script>";
            }
        }
    }
?>
<?php
require './res/php/GoogleAnalytics.php'; // include google analytics
?>
</body>
</html>
