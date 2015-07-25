<?php
/*
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
  * The blog list generator class is a collection of functions for generating blog lists
  * or getting informations about them
  *
  * Since there is no initialize function, I recommend to use the short access syntay
  *
  * @category Blogs
  * @package  RangitakiPHP
  * @author   mmk2410 <marcelmichaelkapfer@yahoo.co.nz>
  * @license  MIT License
  * @link     http://marcel-kapfer.de/rangitaki
  */
class BlogListGenerator
{

    /**
     * A function to generate a blog nav item
     *
     * @param  string $directory            The directory of the blog file
     * @param  string $blogname             The name of the blog file
     * @param  string $blogmaintitle        The name of the main blog
     */
    function listBlog($directory, $blogname, $blogmaintitle)
    {
        $blog = file_get_contents($directory . $blogname); // get content of the blog file
        $blog = $blog . "\n"; // add a line break as a security measurement
        if (substr($blog, 0, 6) == "%TITLE") { // check if the first line includes a title
            $blog = substr($blog, 8, strpos($blog, "\n") - 8); // grab the title
            if ($blog == "main") { // if on main blog
                echo "<a class='nav-item' href='./'>$blogmaintitle</a>"; // create a nav item to the main blog
            } else {
                $link = "./?blog=" . substr($blogname, 0, -3); // create a link to the blog
                echo "<a class='nav-item' href='$link'>$blog</a>"; // create a nav item to the blog
            }
        }
    }

    /**
     * A function to get the name of a blog
     *
     * @param  string $file The path of the blog file
     * @return  string
     */
    function getName($file)
    {
        $blog = file_get_contents($file); // get the content of the blog file
        $blog = $blog . "\n"; // add a line break as a securit measure
        if(substr($blog, 0, 6) == "%TITLE") { // check if first line includes a title
            $blog = substr($blog, 8, strpos($blog, "\n") - 8); // grab the title
            return $blog; // return it
        }
    }

}
