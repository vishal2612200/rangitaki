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
 * Description of BlogListGenerator
 *
 * @author mmk2410 <marcelmichaelkapfer@yahoo.co.nz>
 */
class BlogListGenerator {

    function listBlog($directory, $blogname, $blogmaintitle) {
        $blog = file_get_contents($directory . $blogname);
        $blog = $blog . "\n";
        if (substr($blog, 0, 6) == "%TITLE") {
            $blog = substr($blog, 8, strpos($blog, "\n") - 8);
            if ($blog == "main") {
                echo "<a class='nav-item' href='./'>$blogmaintitle</a>";
            } else {
                $link = "./?blog=" . substr($blogname, 0, -3);
                echo "<a class='nav-item' href='$link'>$blog</a>";
            }
        }
    }
    
    function getName($file){
        $blog = file_get_contents($file);
        $blog = $blog . "\n";
        if(substr($blog, 0, 6) == "%TITLE"){
            $blog = substr($blog, 8, strpos($blog, "\n") - 8);
            return $blog;
        }
    }

}
