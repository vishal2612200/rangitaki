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
    
    function newArticle($directory, $articlefile)
    {
        
        $article = file_get_contents($directory . $articlefile);
        
        echo "<section>";
        
        if(substr($article, 0, 6) == "%TITLE"){
            $title = substr($article, 8, strpos($article, "\n") - 8);
            $link = "./?article=" . substr($articlefile, 0, -3);
            echo "<h2><a href='$link'>$title</a></h2>";
            $article = substr($article, strpos($article, "\n") + 1);
        }
        
        if(substr($article, 0, 5) == "%DATE"){
            $date = substr($article, 7, strpos($article, "\n") - 7);
            echo "<small>$date</small>";
            $article = substr($article, strpos($article, "\n") + 1);
        }
        
        //TODO Code detection
        
        echo Parsedown::instance()
                ->setBreaksEnabled(true)
                ->text($article);
        
        echo "</section>" . "\n";
        
    }
    
}
