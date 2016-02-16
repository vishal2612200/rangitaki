<?php
/**
 * PHP Version 7
 *
 * @category Atom_Feed
 * @package  Rbe
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     https://github.com/mmk2410/rangitaki
 *
 * The MIT License
 *
 * Copyright 2015 mmk2410.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

date_default_timezone_set('UTC');

require "../../vendor/autoload.php";
require_once "../../config.php";
require_once "../../res/php/ArticleGenerator.php";
use PicoFeed\Syndication\Atom;

session_start();

if ($_SESSION['login']) {

    $art_dir = "./../../articles/" . $_GET['blog'] . "/";
    $feed_path = "./../../feed/" . $_GET['blog'] . ".atom";

    $writer = new Atom();

    $writer->title = $blogtitle;
    $writer->site_url = $blogurl;
    $writer->feed_url = $blogurl . "/feed/feed.atom";
    $writer->author = array(
        'name' => $blogauthor,
        'url' => $blogurl,
        'email' => ''
    );

    $articles = scandir($art_dir, 1);

    $amount = 0;

    foreach ($articles as $article) {
        if (strlen($article) >= 3 && substr($article, -3) == ".md") {
            if ($amount == 10) {
                break;
            } else {
                $writer->items[] = array(
                    'title' => ArticleGenerator::getTitle($art_dir, $article),
                    'updated' => strtotime(
                        ArticleGenerator::getDate($art_dir . $article)
                    ),
                    'url' => $blogurl . "./?article=" .
                        substr($article, 0, strlen($article) - 3),
                    'summary'=> ArticleGenerator::getSummary(
                        $art_dir, $articles
                    ),
                    'content' => "<p>" . ArticleGenerator::getText(
                        $art_dir, $articles
                    ) . "</p>"
                );
                $amount += 1;
            }
        }
    }


    $feed = $writer->execute();

    $file = fopen($feed_path, "w");
    if (fwrite($file, $feed) === false) {
        echo "-1";
        exit;
    }
    fclose($file);
    echo "0";
}
?>
