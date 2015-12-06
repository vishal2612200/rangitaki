<?php
$title = $_POST["title"];
$date = $_POST["date"];
$author = $_POST["author"];
$tags = $_POST["tags"];
$text = $_POST["text"];
$filename = $_POST["file"];
$md = <<<EOD
%TITLE: $title
%DATE: $date
%AUTHOR: $author
%TAGS: $tags

$text
EOD;
if (file_put_contents($filename, $md)) {
    echo 0;
} else if (file_exists(($filename))) {
    echo 1;
} else {
    echo -1;
}
