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
    <link rel="stylesheet" type="text/css" href="res/blog.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,400italic,100,100italic,900' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="res/favicon.png">
</head>

<body>
    <div class="header">
        <nobr><a href="index.php" class="title"><?php echo $blogtitle; ?></a></nobr>
        <?php if($_GET['article'] == '' && $bloghome == 'yes'){ ?>
        <a href="<?php echo $bloghomeurl; ?>" class="home"><?php echo $bloghomename; ?></a>
        <?php } ?>
    </div>
    <section>
        <span class="text">
            <?php
                require_once 'res/Parsedown.php';
                require_once 'res/umlautconverter.php';
                require_once 'res/hrefgenerator.php';
                if(file_exists('md/intro.md') && $_GET['article'] == "" && $blogintro == "yes"){
                    $file = file_get_contents('md/intro.md');
                    $intro = Parsedown::instance()
                        ->setBreaksEnabled(true)
                        ->text($file);
                    $UmlautConverter = new UmlautConverter;
                    $intro = $UmlautConverter->convert($intro);
                    echo $intro;
                }
            ?>
        </span>
    </section>
    <!--DON'T CHANGE ANYTHING HERE!-->
    <?php
        $xml = simplexml_load_file('xml/posts.xml');
        $titleArray;
        $i = 0;
        foreach ($xml->post as $post){
            $href = $post->title;
            $HrefGenerator = new HrefGenerator;
            $href = $HrefGenerator->createHref($href);
            $titleArray[$i] = $href;
            $i = $i + 1;
        }
        if($_GET['article'] != ""){
            $an = array_search($_GET['article'], $titleArray, true);
            $post = $xml->post[$an];
    ?>
        <section>
            <span class="texttitlemono">
        <?php
            $title = $post->title;
            $UmlautConverter = new UmlautConverter;
            $title = $UmlautConverter->convert($title);
            echo $title;
        ?>
                <br>
            </span>
            <small>
        <?php
            $pubdate = $post->pubdate;
            $UmlautConverter = new UmlautConverter;
            $pubdate = $UmlautConverter->convert($pubdate);
            echo $pubdate;
        ?>
            </small>
            <p class="text">
        <?php
            $content = Parsedown::instance()
                ->setBreaksEnabled(true)
                ->text($post->content);
            $UmlautConverter = new UmlautConverter;
            $content = $UmlautConverter->convert($content);
            echo $content;
        ?>
            </p>
            <p align="right">
        <?php
            foreach ($post->otherlinks->otherlb as $olb){
        ?>
            <a class="button_white" target="_blank" href="
            <?php
                $otherurl = $olb->otherurl;
                $UmlautConverter = new UmlautConverter;
                $otherurl = $UmlautConverter->convert($otherurl);
                echo $otherurl;
            ?>
            ">
        <?php
            $otherlink = $olb->otherlink;
            $UmlautConverter = new UmlautConverter;
            $otherlink = $UmlautConverter->convert($otherlink);
            echo $otherlink;
        ?>
            </a>
        <?php
            }
            foreach($post->mainlink as $mainlink){
        ?>
                <a class="button_color" target="_blank" href="
                   <?php
                    $mainurl = $post->mainurl;
                    $UmlautConverter = new UmlautConverter;
                    $mainurl = $UmlautConverter->convert($mainurl);
                    echo $mainurl;
                    ?>
                   ">
        <?php
                $mainlink = $post->mainlink;
                $UmlautConverter = new UmlautConverter;
                $mainlink = $UmlautConverter->convert($mainlink);
                echo $mainlink;
        ?>
                </a>
        <?php } ?>
            </p>
            <?php include 'res/SocialBar.php'; ?>
            <?php if($blogdisqus == 'yes' && $blogdisqusname != ''){ ?>
            <div id="disqus_thread"></div>
            <script type="text/javascript">
                /* * * CONFIGURATION VARIABLES * * */
                var disqus_shortname = '<?php echo $blogdisqusname; ?>';
    
                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
            <?php } ?>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
        </section>
    <?php    
        } else {
    ?>
        <?php
        foreach ($xml->post as $post){
        ?>
        <section>
            <a class="texttitle" href="
        <?php
            $href = $post->title;
            $HrefGenerator = new HrefGenerator;
            $href = $HrefGenerator->createHref($href);
            echo 'index.php?article=' . $href;
        ?>
               ">
        <?php
            $title = $post->title;
            $UmlautConverter = new UmlautConverter;
            $title = $UmlautConverter->convert($title);
            echo $title;
        ?>
                <br>
            </a>
            <small>
        <?php
            $pubdate = $post->pubdate;
            $UmlautConverter = new UmlautConverter;
            $pubdate = $UmlautConverter->convert($pubdate);
            echo $pubdate;
        ?>
            </small>
            <p class="text">
        <?php
            $content = Parsedown::instance()
                ->setBreaksEnabled(true)
                ->text($post->content);
            $UmlautConverter = new UmlautConverter;
            $content = $UmlautConverter->convert($content);
            echo $content;
        ?>
            </p>
            <p align="right">
        <?php
            foreach ($post->otherlinks->otherlb as $olb){
        ?>
            <a class="button_white" target="_blank" href="
            <?php
                $otherurl = $olb->otherurl;
                $UmlautConverter = new UmlautConverter;
                $otherurl = $UmlautConverter->convert($otherurl);
                echo $otherurl;
            ?>
            ">
        <?php
            $otherlink = $olb->otherlink;
            $UmlautConverter = new UmlautConverter;
            $otherlink = $UmlautConverter->convert($otherlink);
            echo $otherlink;
        ?>
            </a>
        <?php
            }
            foreach($post->mainlink as $mainlink){
        ?>
                <a class="button_color" target="_blank" href="
                   <?php
                    $mainurl = $post->mainurl;
                    $UmlautConverter = new UmlautConverter;
                    $mainurl = $UmlautConverter->convert($mainurl);
                    echo $mainurl;
                    ?>
                   ">
        <?php
                $mainlink = $post->mainlink;
                $UmlautConverter = new UmlautConverter;
                $mainlink = $UmlautConverter->convert($mainlink);
                echo $mainlink;
        ?>
                </a>
        <?php } ?>
            </p>
        </section>
        <?php
        }
        }
        ?>
        <div class="box_container">
            <p class="cc">
                <?php echo $blogfooter ?>
            </p>
        </div>
    </body>
</html>
