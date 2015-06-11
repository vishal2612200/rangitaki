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

<?php include 'config.php'; ?>

<head>
    <title><?php echo $blogtitle; ?></title>
    <!--Metatags-->
    <meta name="author" content="<?php echo $blogauthor; ?>" />
    <meta name="description" content="<?php echo $blogdescription; ?>" />
    <meta name="theme-color" content="#ac2900"/>
    <meta http-equiv="CACHE-CONTROL" content="no-cache" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <!--CSS no change needed-->
    <link rel="stylesheet" type="text/css" href="res/css/blog.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,400italic,100,100italic,900' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="res/favicon.png">
    <link rel="stylesheet" href="./res/css/github-gist.css">
    <script src="./res/js/highlight.pack.js"></script>
    <script>hljs.initHighlightingOnLoad();</script>
</head>

<body>
    <div class="header">
        <nobr><a href="./" class="title"><?php echo $blogtitle; ?></a></nobr>
        <?php if($_GET['article'] == '' && $bloghome == 'yes'){ ?>
        <a href="<?php echo $bloghomeurl; ?>" class="home"><?php echo $bloghomename; ?></a>
        <?php } ?>
    </div>
    <section>
        <span class="text">
            <?php
                require_once 'res/php/Parsedown.php';
                require_once 'res/php/ArticleGenerator.php';
                if(file_exists('md/intro.md') && $_GET['article'] == "" && $blogintro == "yes"){
                    $file = file_get_contents('md/intro.md');
                    $intro = Parsedown::instance()
                        ->setBreaksEnabled(true)
                        ->text($file);
                    echo $intro;
                }
            ?>
        </span>
    </section>
    <?php
        if($_GET['article'] == ""){
            $articles = scandir("./articles/", 1);
            foreach ($articles as $article) {
                if(strlen($article) >= 3 && substr($article, -3) == ".md"){
                    ArticleGenerator::newArticle("./articles/", $article);
                }
            }
        } else {
            ArticleGenerator::newArticle("./articles/", $_GET['article'] . ".md");
            include './res/php/SocialBar.php';
            include './res/php/Disqus.php';
        }
    ?>
        <div class="box_container">
            <p class="cc">
                <?php echo $blogfooter; ?>
            </p>
        </div>
    <?php
        include './res/php/GoogleAnalytics.php';
    ?>
    </body>
</html>
