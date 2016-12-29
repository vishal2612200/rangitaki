<?php
/**
 * PHP Version 7
 *
 * Rangitaki Project
 *
 * @category Blogs
 * @package  RangitakiPHP
 * @author   mmk2410 <marcelmichaelkapfer@yahoo.co.nz>
 * @license  MIT License
 * @link     http://marcel-kapfer.de/rangitaki
 */
namespace mmk2410\rbe\BlogListGenerator;

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
    public function listBlog($directory, $blogname, $blogmaintitle)
    {
        // get content of the blog file;
        $blog = file_get_contents($directory . $blogname);
        // add a line break as a security measurement
        $blog = $blog . "\n";
        // check if the first line includes a title
        if (substr($blog, 0, 6) == "%TITLE") {
            // grab the title
            $itemname = substr($blog, 8, strpos($blog, "\n") - 8);
            // if on main blog
            if ($itemname == "main") {
                // create a nav item to the main blog
                $atag = "<a class='nav-item' href='./'>$blogmaintitle</a>";
            } else {
                // create a link to the blog
                $link = "./?blog=" . substr($blogname, 0, -3);
                // create a nav item to the blog
                $atag = "<a class='nav-item' href='$link'>$itemname</a>";
            }
            $blog = substr($blog, strpos($blog, "\n") + 1);
        }
        // nav item as link to external page
        if (substr($blog, 0, 4) == "%URL") {
            $itemurl = substr($blog, 6, strpos($blog, "\n") - 6);
            $atag = "<a class='nav-item' href='$itemurl'>$itemname</a>";
        }
        return $atag;
    }

    /**
     * A function to get the name of a blog
     *
     * @param string $file The path of the blog file
     *
     * @return string
     */
    public function getName($file)
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
    public static function getArticleAmount($blog)
    {
        $directory = "./articles/" . $blog . "/";
        if (!file_exists($directory)) {
            return 0;
        } else {
            $i = 0;
            $handle = opendir($directory);
            while (($file = readdir($handle)) !== false) {
                if (!in_array($file, array('.','..'))) {
                    $i++;
                }
            }
            return $i;
        }
    }
    
    /**
     * A function returning the external linkn of
     * a blog.
     *
     * @param string $blog the blog name
     * @param string $dir root directory of installation
     *
     * @return string link to external page else null
     */
    public function getExternalLink($blog, $dir)
    {
        $path = $dir . "/blogs/" . $blog;
        $blog = file_get_contents($path) . "\n";
        if (substr($blog, 0, 6) == "%TITLE") {
            $blog = substr($blog, strpos($blog, "\n") + 1);
        }
        if (substr($blog, 0, 4) == "%URL") {
            return substr($blog, 6, strpos($blog, "\n") - 6);
        }
        return null;
    }
}
