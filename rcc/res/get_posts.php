<?php
/**
 * PHP Version 7
 *
 * @category Blogging
 * @package  Rcc
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     https://mmk2410.org/rangitaki
 *
 * get post script
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
 *
 * Error Codes:
 * 901      No blog given as get argument
 * 921      No blog with the given name available
 */

session_start();
if ($_SESSION['login']) {
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
}
