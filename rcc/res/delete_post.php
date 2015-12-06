<?php
/**
 * User: mmk2410
 * Date: 12/6/15
 *
 * Error Codes:
 * 901      No post given as get argument
 * 921      No post with the given name available
 * 941      No blog given as get argument
 * 961      Error while deleting the post
 */
$post = $_GET["post"];
$blog = $_GET["blog"];
if (!isset($post)) {
    echo "901";
} else if (!isset($blog)) {
    echo "941";
} else if (!file_exists("./../../articles/$blog/$post.md")) {
    echo "921";
} else {
    if (unlink("./../../articles/$blog/$post.md")) {
        echo "0";
    }
    echo "961";
}
