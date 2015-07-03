<!DOCTYPE HTML>
<!-- pBlog https://github.com/mmk2410/pblog -->
<!--
The MIT License

Copyright 2015 mmk2410.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
-->
<html>

    <?php
    include 'config.php';
    require_once 'res/php/Parsedown.php';
    require_once 'res/php/ArticleGenerator.php';
    require_once './res/php/BlogListGenerator.php';
    $getblog = filter_input(INPUT_GET, "blog");
    $getarticle = filter_input(INPUT_GET, "article");
    $gettag = filter_input(INPUT_GET, "tag");
    $url = "http://" .  filter_input(INPUT_SERVER, "HTTP_HOST") . filter_input(INPUT_SERVER, "REQUEST_URI");
    ?>

    <head>
        <title><?php echo $blogtitle; ?></title>
        <!--Metatags-->
        <meta name="author" content="<?php echo $blogauthor; ?>" />
        <meta name="description" content="<?php echo $blogdescription; ?>" />
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <!--CSS no change needed-->
        <link rel="stylesheet" type="text/css" href="res/css/rangitaki.css" />
        <link rel="stylesheet" type="text/css" href="themes/<?php echo $theme; ?>.css" />
        <?php
        if ($nav_drawer == 'no') {
            ?>
            <link rel="stylesheet" type="text/css" href="res/css/no-nav.css" />
            <?php
        }
        ?>
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,400italic,100,100italic,900' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" href="res/favicon.png">
        <link rel="stylesheet" href="./res/css/github-gist.css">
        <script src="./res/js/highlight.pack.js"></script>
        <script>hljs.initHighlightingOnLoad();</script>
    </head>

    <body>
        <?php if ($nav_drawer == "yes") { ?>
            <div class="overlay"></div>
            <div class="nav">
                <div class="divider"></div>
                <?php
                if ($getarticle == "") {
                    echo "<section>";
                    echo "<div class='nav-item-static'>Blogs of $blogtitle:</div>";
                    $blogs = scandir("./blogs/");
                    foreach ($blogs as $blog) {
                        if (strlen($blog) >= 3 && substr($blog, -3) == ".md") {
                            if ($getblog == "") {
                                if ($blog != "main.md") {
                                    if(empty($blogmainname)){
                                        $blogmaintitle = $blogtitle;
                                    } else {
                                        $blogmaintitle = $blogmainname;
                                    }
                                    BlogListGenerator::listBlog("./blogs/", $blog, $blogtitle);
                                }
                            } else {
                                if ($getblog . ".md" != $blog) {
                                    if(empty($blogmainname)){
                                        $blogmaintitle = $blogtitle;
                                    } else {
                                        $blogmaintitle = $blogmainname;
                                    }
                                    BlogListGenerator::listBlog("./blogs/", $blog, $blogmaintitle);
                                }
                            }
                        }
                    }
                    echo "</section>";
                } else {
                    ?>
                    <a class="nav-item" onclick="goBack()">Go back</a>
                    <?php
                }
                ?>
                <div class="divider"></div>
                <a class="nav-item" href="<?php echo $bloghomeurl; ?>"><?php echo $bloghomename; ?></a>
            </div>
            <?php
        }

        if ($getblog == "") {
            $blog = "main";
        } else {
            $blog = $getblog;
        }
        ?>
        <div class="main">
            <div class="header">
                <img src="./res/img/menu.svg" class="nav-img" />
                <nobr><a href="./" class="title"><?php echo $blogtitle; ?></a></nobr>
            </div>
            <?php
            if (file_exists("blogs/$blog.md") && $getarticle == "" && $blogintro == "yes" && $gettag == "") {
                $file = file_get_contents("blogs/$blog.md");
                $file = $file . "\n";
                $file = substr($file, strpos($file, "\n"));
                if ($file != "" && $file != "\n" && $file != " ") {
                    ?>
                    <section class="card">
                        <div class="articletext">
                            <?php
                            $intro = Parsedown::instance()
                                    ->setBreaksEnabled(true)
                                    ->text($file);
                            echo $intro;
                            ?>
                        </div>
                    </section>
                    <?php
                }
            }
            $articlesdir = "./articles/$blog/";
            if ($gettag != "") {
                $articles = scandir($articlesdir, 1);
                foreach ($articles as $article) {
                    $tags = ArticleGenerator::getTags($articlesdir, $article);
                    if (in_array($gettag, $tags)) {
                        if (strlen($article) >= 3 && substr($article, -3) == ".md") {
                            ArticleGenerator::newArticle($articlesdir, $article, $getblog);
                        }
                    }
                }
            } else if ($getarticle == "") {
                $articles = scandir($articlesdir, 1);
                foreach ($articles as $article) {
                    if (strlen($article) >= 3 && substr($article, -3) == ".md") {
                        ArticleGenerator::newArticle($articlesdir, $article, $getblog);
                    }
                }
            } else {
                ArticleGenerator::newArticle($articlesdir, $getarticle . ".md", $getblog);
                include './res/php/SocialBar.php';
                include './res/php/Disqus.php';
            }
            ?>
            <div class="footer">
                <?php echo $blogfooter; ?>
            </div>
            <div class="fabmenu">
                <div class="subfab">
                    <a href='mailto:?subject=<?php echo $blogtitle; ?>&body=Check out this blog: <?php echo $url; ?>'  target="blank">
                        <img src="./res/img/email.svg" class="subfab-img" />
                    </a>
                </div>
                <div class="subfab">    
                    <a href='https://twitter.com/intent/tweet?text=Check out: <?php echo $url; ?>&original_referer='  target="blank">
                        <img src="./res/img/twitter.svg" class="subfab-img" />
                    </a>
                </div>
                <div class="subfab">
                    <a href='https://plus.google.com/share?url=<?php echo $url; ?>&hl=en-US'  target="blank">
                        <img src="./res/img/gplus.svg" class="subfab-img" />
                    </a>
                </div>
                <div class="subfab">
                    <a href='https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>&t=<?php echo "echo $blogtitle" ?>' target="blank">
                        <img src="./res/img/facebook.svg" class="subfab-img" />
                    </a>
                </div>
                <div class="fab">
                    <img src="./res/img/share.svg" class="fab-img" alt="Share" />
                </div>
            </div>
        </div>
        <script src="./res/js/jquery-2.1.4.min.js"></script>
        <script src="./res/js/app.js"></script>
        <?php
        include './res/php/GoogleAnalytics.php';
        ?>
    </body>
</html>
