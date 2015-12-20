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

if ($pagination) {
?>
    <div class="pag_buttons">
<?php
    if ($pag_min > 0) {
        if (isset($getblog)) {
?>
    <a href="<?php
            echo "?blog=" . $getblog . "&page=" . ($pagenumber - 1);
?>" class="pag_prev button">PREVIOUS PAGE</a>
<?php
        } else {
?>
    <a href="<?php
            echo "?page=" . ($pagenumber - 1);
?>" class="pag_prev button">PREVIOUS PAGE</a>
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
?>" class="pag_next button">NEXT PAGE</a>
<?php
        } else {
?>
    <a href="<?php
            echo "?page=" . ($pagenumber + 1);
?>" class="pag_next button">NEXT PAGE</a>
<?php
        }
    }
?>
</div>
<?php
}
?>
