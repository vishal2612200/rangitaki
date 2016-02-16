<?php
/**
 * PHP Version 7
 *
 * Since there is no initialize function, I recommend to use the short access syntay
 *
 * @category Articles
 * @package  RangitakiPHP
 * @author   mmk2410 <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 *
 * Rangitaki Project
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

/**
 * The article generator class is a collection of functions for generating the
 * article of markdown
 *
 * Since there is no initialize function, I recommend to use the short access syntay
 *
 * @category Articles
 * @package  RangitakiPHP
 * @author   mmk2410 <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */
class ArticleGenerator
{

    /**
     * A function to create one new article
     *
     * @param string $directory   The directory where the article files are stored
     * @param string $articlefile The name of the article file
     * @param string $blog        The name of the current blog
     *
     * @return Null
     */
    function newArticle($directory, $articlefile, $blog)
    {

        $article = file_get_contents($directory . $articlefile); // get the file

        echo "<section class='card'>";

        if (substr($article, 0, 6) == "%TITLE") { // if a title is in the first line
            $title = substr($article, 8, strpos($article, "\n") - 8); // get this title
            if ($blog == "") { // if one main blog
                $link = "./?article=" . substr($articlefile, 0, -3); // create link to article
            } else { // if not on main blog
                $link = "./?blog=$blog&article=" . substr($articlefile, 0, -3); // create link to article at specific blog
            }
            echo "<a href='$link' class='headline'>$title</a>"; // print link (as a headline)
            $article = substr($article, strpos($article, "\n") + 1); // remove title tag from $article (the variable, not the document)
        }

        if (substr($article, 0, 5) == "%DATE") { // if now a date is in the first line
            $date = substr($article, 7, strpos($article, "\n") - 7); // get this date
            echo "<span class='date'>$date</span>"; // print the date
            $article = substr($article, strpos($article, "\n") + 1); // remove this line
        }

        if (substr($article, 0, 7) == "%AUTHOR") { // if a author is now in the first line
            $author = substr($article, 9, strpos($article, "\n") - 9); // get the author
            $article = substr($article, strpos($article, "\n") + 1); // remove the line
        }

        if (substr($article, 0, 5) == "%TAGS") { // if tags are now at the beginning
            $tags = substr($article, 7, strpos($article, "\n") - 7); // get tags
            $tags = explode(", ", $tags); // split them into an array
            $article = substr($article, strpos($article, "\n") + 1); // remove this line
        }

        echo "<div class='articletext'>";

        echo Parsedown::instance()
                ->setBreaksEnabled(true)
                ->text($article); // print now the article text as html

        echo "</div>";

        if (isset($author)) {
            echo "<span class='author'>$author</span>"; // print the author
        }

        if (isset($tags)) {
            foreach ($tags as $tag) {
                $blogurl = filter_input(INPUT_GET, "blog");
                if ($blogurl == "") { // on main blog. no ?blog=
                    echo "<a class='tag' href='./?tag=$tag'>$tag</a> ";
                } else { // not on main blog
                    echo "<a class='tag' href='./?blog=$blog&tag=$tag'>$tag</a> ";
                }
            }
        }

        echo "</section>" . "\n";
    }

    /**
     * A function to get an articles tags as an array
     *
     * @param  string $directory   The directory where the article files are stored
     * @param  string $articlefile The name of the article file
     * @return array
     */
    static function getTags($directory, $articlefile)
    {
        $article = file_get_contents($directory . $articlefile); // get the article
        if (substr($article, 0, 6) == "%TITLE") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%DATE") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 7) == "%AUTHOR") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }
        if (substr($article, 0, 5) == "%TAGS") { // detect the tags
            $tags = substr($article, 7, strpos($article, "\n") - 7); // get the tags
            $tags = explode(", ", $tags); // split them into an array
        }
        return $tags; // remove that array
    }

    /**
     * A function to get an article title as a string
     *
     * @param  string $directory   The directory where the article files are stored
     * @param  string $articlefile The name of the article file
     * @return string
     */
    static function getTitle($directory, $articlefile)
    {
        $article = file_get_contents($directory . $articlefile); // get the article
        if (substr($article, 0, 6) == "%TITLE") { // detect and remove the title
            $title = substr($article, 8, strpos($article, "\n") - 8); // get this title
            return $title; // remove that array
        }
    }

    /**
     * A function to get the date of an article
     *
     * @param $directory    The directory where the article is stored
     * @param $articlefile  The name of the article file
     * @return string
     */
    static function getDate($directory, $articlefile)
    {
        $article = file_get_contents($directory . $articlefile);

        if (substr($article, 0, 6) == "%TITLE") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%DATE") { // detect and remove the title
            $date = substr($article, 7, strpos($article, "\n") - 7);
            return $date;
        }
    }


    /**
     * A function to get a short summary of a text
     *
     * @param $directory    The directory where the article is stored
     * @param $articlefile  The name of the article file
     *
     * @return string
     */
    static function getSummary($directory, $articlefile)
    {
        $text = getText($directory, $articlefile);

        $pos = stripos($text, ".");

        if ($pos) {
            $offset = $pos + 1;
            $pos = stripos($text, ".", $offset);
            $summary = substr($text, 0, $pos) . ".";
            return $summary;
        } else {
            return $text;
        }
    }

    /**
     * A function to get the author of an article
     *
     * @param $directory    The directory where the article is stored
     * @param $articlefile  The name of the article file
     * @return string
     */
    static function getAuthor($directory, $articlefile)
    {
        $article = file_get_contents($directory . $articlefile);

        if (substr($article, 0, 6) == "%TITLE") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%DATE") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 7) == "%AUTHOR") { // detect and remove the title
            $author = substr($article, 9, strpos($article, "\n") - 9);
            return $author;
        }
    }

    /**
     * A function to get the text of an article
     *
     * @param $directory    The directory where the article is stored
     * @param $articlefile  The name of the article file
     * @return string
     */
    static function getText($directory, $articlefile)
    {
        $article = file_get_contents($directory . $articlefile);

        if (substr($article, 0, 6) == "%TITLE") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%DATE") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 7) == "%AUTHOR") { // detect and remove the title
            $article = substr($article, strpos($article, "\n") + 1);
        }

        if (substr($article, 0, 5) == "%TAGS") { // detect the tags
            $article = substr($article, strpos($article, "\n") + 1); // remove the tags
        }

        return $article;
    }

}
