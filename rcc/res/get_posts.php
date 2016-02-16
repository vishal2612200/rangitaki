<?php
/**
 * PHP Version 7
 *
 * User: mmk2410
 * Date: 12/6/15
 *
 * Error Codes:
 * 901      No blog given as get argument
 * 921      No blog with the given name available
 */
$blog = $_GET["blog"];
if (!isset($blog)) {
    echo "901";
} else if (!file_exists("./../../blogs/$blog.md")) {
    echo "921";
} else {
    $posts = array();
    $i = 0;
    foreach (scandir("./../../articles/$blog/") as $article) {
        if (substr($article, -3) == ".md") {
            $posts[$i] = $article;
            $i++;
        }
    }
    print json_encode($posts);
}
