<?php
/**
 * PHP Version 5
 *
 * PHP script for creating the next / prev page links
 *
 * @category Pagination
 * @package  Rbe
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */
require_once "BlogListGenerator.php";
require_once "config.php";
require_once "lang/" . $language . ".php";

if ($pagination) {
?>
    <div class="pag_buttons">
<?php
    if ($pag_min > 0) {
        if (isset($getblog)) {
?>
    <a href="<?php
            echo "?blog=" . $getblog . "&page=" . ($pagenumber - 1);
            ?>" class="pag_prev button"><?php echo $BLOGLANG["Previous Page"]; ?></a>
<?php
        } else {
?>
    <a href="<?php
            echo "?page=" . ($pagenumber - 1);
            ?>" class="pag_prev button"><?php echo $BLOGLANG['Previous Page']; ?></a>
<?php
        }
    }
    if (isset($getblog)) {
        $pag_blog = $getblog;
    } else {
        $pag_blog = "main";
    }
    if ($pag_max < BlogListGenerator::getArticleAmount($pag_blog)) {
        if (isset($getblog)) {
?>
    <a href="<?php
            echo "?blog=" . $getblog . "&page=" . ($pagenumber + 1);
            ?>" class="pag_next button"><?php echo $BLOGLANG["Next Page"]; ?></a>
<?php
        } else {
?>
    <a href="<?php
            echo "?page=" . ($pagenumber + 1);
            ?>" class="pag_next button"><?php echo $BLOGLANG["Next Page"];?></a>
<?php
        }
    }
?>
</div>
<?php
}
?>
