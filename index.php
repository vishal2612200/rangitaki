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
        <nobr><a href="index.php" class="title">Blog</a></nobr>
        <!--Set here the link to your Homepage or delete the following line-->
        <a href="../" class="home">Home</a>
    </div>
    <!--DON'T CHANGE ANYTHING HERE!-->
    <?php
        require_once 'res/Parsedown.php';
        $xml = simplexml_load_file('xml/posts.xml');
    ?>
        <?php
        foreach ($xml->post as $post){
        ?>
        <section>
            <p class="texttitle">
        <?php
            echo $post->title;
        ?>
            </p>
            <small>
        <?php
            echo $post->pubdate;
        ?>
            </small>
            <p class="text">
        <?php
            echo Parsedown::instance()
                ->setBreaksEnabled(true)
                ->text($post->content);
        ?>
            </p>
            <p align="right">
        <?php
            foreach ($post->otherlinks->otherlb as $olb){  
        ?>
            <a class="button_white" target="_blank" href="
            <?php
                echo $olb->otherurl;
            ?>
            ">
        <?php
            echo $olb->otherlink;
        ?>
            </a>
        <?php
            }
            foreach($post->mainlink as $mainlink){
        ?>
                <a class="button_color" target="_blank" href="
                   <?php 
                            echo $post->mainurl;
                    ?>
                   ">
        <?php
                 echo $post->mainlink;
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
                pBlog <?php echo date("Y"); ?>
            </p>
        </div>
    </body>
</html>
