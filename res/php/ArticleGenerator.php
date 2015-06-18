<?php

/*
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

/**
 * Description of ArticleGenerator
 *
 * @author mmk2410 <marcelmichaelkapfer@yahoo.co.nz>
 */
class ArticleGenerator {

    function newArticle ($directory, $articlefile, $blog) {

        $article = file_get_contents($directory . $articlefile);

        echo "<section class='card'>";

        if (substr($article, 0, 6) == "%TITLE") {
            $title = substr($article, 8, strpos($article, "\n") - 8);
            if ($blog == "") {
                $link = "./?article=" . substr($articlefile, 0, -3);
            } else {
                $link = "./?blog=$blog&article=" . substr($articlefile, 0, -3);
            }
            echo "<a href='$link' class='headline'>$title</a>";
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%DATE") {
            $date = substr($article, 7, strpos($article, "\n") - 7);
            echo "<span class='date'>$date</span>";
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 7) == "%AUTHOR") {
            $author = substr($article, 9, strpos($article, "\n") - 9);
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%TAGS") {
            $tags = substr($article, 7, strpos($article, "\n") - 7);
            $tags = explode(", ", $tags);
            $article = substr($article, strpos($article, "\n") + 1);
        }

        //TODO Code detection

        echo "<div class='articletext'>";

        echo Parsedown::instance()
                ->setBreaksEnabled(true)
                ->text($article);

        echo "</div>";

        if ($author != "") {
            echo "<span class='author'>$author</span>";
        }

        foreach ($tags as $tag) {
            $blogurl = filter_input(INPUT_GET, "blog");
            if ($blogurl == "") {
                echo "<a class='tag' href='./?tag=$tag'>$tag</a> ";
            } else {
                echo "<a class='tag' href='./?blog=$blog&tag=$tag'>$tag</a> ";
            }
        }

        echo "</section>" . "\n";
    }

    function getTags($directory, $articlefile) {
        $article = file_get_contents($directory . $articlefile);
        if (substr($article, 0, 6) == "%TITLE") {
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%DATE") {
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 7) == "%AUTHOR") {
            $article = substr($article, strpos($article, "\n") + 1);
        }
        if (substr($article, 0, 5) == "%TAGS") {
            $tags = substr($article, 7, strpos($article, "\n") - 7);
            $tags = explode(", ", $tags);
        }
        return $tags;
    }

}
