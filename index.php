<!DOCTYPE HTML>
<!-- pBlog https://github.com/mmk2410/pblog -->
<html>
<!-- For a good representation of the source code use an tab width which is not more than 4-->

<head>
    <!--Replace pBlog with your Blogtitle-->
    <title>pBlog</title>
    <!--Metatags
    You don't have to change here anything, but I recommend to add an author and description tag-->
    <meta name="theme-color" content="#ac2900"/>
    <meta http-equiv="CACHE-CONTROL" content="no-cache" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <!--CSS
    no change needed-->
    <link rel="stylesheet" type="text/css" href="res/blog.css" />
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,400italic,100,100italic,900' rel='stylesheet' type='text/css'>
    <!-- Set here the link to your favicon-->
    <link rel="shortcut icon" href="../images/favicons/deep_orange.png">
</head>

<body>
    <div class="header">
        <!--Replace 'index.php' with the link to this file
        and 'Blog' with your Blogtitle-->
        <nobr><a href="index.php" class="title">pBlog</a></nobr>
        <!--Set here the link to your Homepage or delete the following line-->
        <a href="../" class="home">Home</a>
    </div>
    <!-- This is the Intro section. You can set your intro text in md/intro.md. In case you don't want an intro delete this whole section until the next comment-->
    <section>
        <span class="text">
            <?php
                require_once 'res/Parsedown.php';
                require_once 'res/umlautconverter.php';
                if(file_exists('md/intro.md')){
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
    <!-- In case you don't want a Intro section delete the above section-->
    <!--DON'T CHANGE ANYTHING HERE!-->
    <?php
        $xml = simplexml_load_file('xml/posts.xml');
    ?>
        <?php
        foreach ($xml->post as $post){
        ?>
        <section>
            <p class="texttitle">
        <?php
            $title = $post->title;
            $UmlautConverter = new UmlautConverter;
            $title = $UmlautConverter->convert($title);
            echo $title;
        ?>
            </p>
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
        ?>
        <div class="box_container">
            <!--Set here your personal copyright info-->
            <p class="cc">
                pBlog <?php echo date("Y"); ?> <a href="https://github.com/mmk2410/pBlog" target="blank">github.com/mmk2410/pBlog</a>
            </p>
        </div>
    </body>
</html>
