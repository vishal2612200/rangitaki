<?php
/**
 * PHP Version 5.6
 *
 * Rangitaki Project
 *
 * @category Blogs
 * @package  RangitakiPHP
 * @author   mmk2410 <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */


/**
 * The blog list generator class is a collection of functions for generating
 * blog list
 * or getting informations about them
 *
 * Since there is no initialize function, I recommend to use the short
 * access syntay
 *
 * @category Generator
 * @package  Rbe
 * @author   Marcel Kapfer (mmk2410) <marcelmichaelkapfer@yahoo>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */
class BlogListGenerator
{
    /**
     * A function to generate a blog nav item
     *
     * @param string $directory     The directory of the blog file
     * @param string $blogname      The name of the blog file
     * @param string $blogmaintitle The name of the main blog
     *
     * @return None
     */
    function listBlog($directory, $blogname, $blogmaintitle)
    {
        // get content of the blog file;
        $blog = file_get_contents($directory . $blogname);
        // add a line break as a security measurement
        $blog = $blog . "\n";
        // check if the first line includes a title
        if (substr($blog, 0, 6) == "%TITLE") {
            // grab the title
            $blog = substr($blog, 8, strpos($blog, "\n") - 8);
            // if on main blog
            if ($blog == "main") {
                // create a nav item to the main blog
                echo "<a class='nav-item' href='./'>$blogmaintitle</a>";
            } else {
                // create a link to the blog
                $link = "./?blog=" . substr($blogname, 0, -3);
                // create a nav item to the blog
                echo "<a class='nav-item' href='$link'>$blog</a>";
            }
        }
    }

    /**
     * A function to get the name of a blog
     *
     * @param string $file The path of the blog file
     *
     * @return string
     */
    function getName($file)
    {
        // get the content of the blog file
        $blog = file_get_contents($file);
        // add a line break as a securit measure
        $blog = $blog . "\n";
        // check if first line includes a title
        if (substr($blog, 0, 6) == "%TITLE") {
            // grab the title
            $blog = substr($blog, 8, strpos($blog, "\n") - 8);
            return $blog;
        }
    }

    /**
     * A function to recieve the amount of articles
     * of a blog
     *
     * @param string $blog the blog name
     *
     * @return int Amount of files
     */
    static function getArticleAmount($blog)
    {
        $directory = "./articles/" . $blog . "/";
        if (!file_exists($directory)) {
            return 0;
        } else {
            $i = 0;
            $handle = opendir($directory);
            while (($file = readdir($handle)) !== false ) {
                if (!in_array($file, array('.','..'))) {
                    $i++;
                }
            }
            return $i;
        }
    }

}
