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
 * Main page of RCC (Rangitaki Control Center)
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">

    <title>Rangitaki Control Center</title>

    <meta name="robots" content="nofollow, noindex, noarchive, nosnippet">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0,
                    user-scalable=0" name="viewport"/>

    <meta name="theme-color" content="#383838">
    <meta name="description" content="Rangitaki Control Center (RCC)">

    <link rel="stylesheet" href="./res/rcc.css"/>

    <link href='//fonts.googleapis.com/css?family=Roboto:400,500,700,300,
            400italic,100,100italic,900' rel='stylesheet'
            type='text/css'> <!--Font-->
</head>

<body>

    <div class="header">
        <a href="./" class="title">Rangitaki Control Center</a>
        <a href="../" class="back">Back to the blog</a>
    </div>

    <div class="main">
<?php
require '../config.php';

if ($rcc == "yes") {

    include 'password.php';
    session_start();

    if (isset($_POST['passwd'])) {
        $passwd = $_POST['passwd'];
        $_SESSION['passwd'] = $_POST['passwd'];
    } else if (isset($_SESSION['passwd'])) {
        $passwd = $_SESSION['passwd'];
    }

    if ($passwd == "") {
?>

        <!-- Login Card -->
        <section class="card">
            <div class="headline">Log In</div>
            <form action="./" method="post">
                <p>Password:
                    <br><br>
                    <input type="password" class="itextfield" name="passwd"/>
                </p>

                <input type="Submit" class="button" value="Log in"/>
            </form>
        </section>

    <?php
    } else {

        if ($passwd == $password) {
            $_SESSION['login'] = true;
            include_once "./../res/php/BlogListGenerator.php";
    ?>

        <!-- Post Upload -->
        <section class="card">
            <div class="headline">Post Upload</div>
            <form enctype="multipart/form-data" action="uploaded/"
                method="POST">

                <select name="blog">
            <?php
            $blogs = scandir("../blogs/");
            foreach ($blogs as $blog) {
                if (strlen($blog) >= 3 && substr($blog, -3) == ".md") {
                    $blog = substr($blog, 0, -3);
                    echo "<option value='$blog'>$blog</option>";
                }
            }
            ?>
                </select>

                <input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
                <input id="" name="userfile" type="file" value="Choose a file"/>
                <br><br>

                <input id="button" type="submit" value="Upload" class="button"/>
            </form>
        </section>

        <!-- New Post -->
        <section class="card">
            <div class="headline">New Post</div>
            <form action="newpost/" method="POST">
                <p>Blog:</p>
                <select name="blog">
            <?php
            $blogs = scandir("../blogs/");
            foreach ($blogs as $blog) {
                if (strlen($blog) >= 3 && substr($blog, -3) == ".md") {
                    $blog = substr($blog, 0, -3);
                    echo "<option value='$blog'>$blog</option>";
                }
            }
            ?>
                </select>

                <p>Title:
                    <br><br>
                    <input type="text" class="itextfield" name="title"/>
                </p>

                <p>Date:
                    <br><br>
                    <input type="text" class="itextfield" name="date"/>
                </p>

                <p>Author:
                    <br><br>
                    <input type="text" class="itextfield" name="author"/>
                </p>

                <p>Tags:
                    <br><br>
                    <input type="text" class="itextfield" name="tags"/>
                </p>

                <p>Text:</p>
                <textarea class="itextarea" name="text"></textarea>
                <br><br>
                <input id="button" type="submit" value="Post"
                    class="button"/>
            </form>
        </section>

        <!-- Edit post -->
        <section class="card">
            <div class="headline">Edit post</div>
            <p>
                First select the blog of the post you wan't to edit.
            </p>

            <p id="edit_select_blog">
                <select name="blog" id="edit_selected_blog">
            <?php
            $blogs = scandir("../blogs/");
            foreach ($blogs as $blog) {
                if (strlen($blog) >= 3 && substr($blog, -3) == ".md") {
                    $blog = substr($blog, 0, -3);
                    echo "<option value='$blog'>$blog</option>";
                }
            }
            ?>
                </select>
            </p>
            <a class="button" id="edit_get_posts">GET POSTS</a>
        </section>

        <!-- Delete Post -->
        <section class="card">
            <div class="headline">Delete Post</div>
            <p>
                First select the subblog of the post you want to delete.
            </p>

            <p id="delete_select_blog">
                <select name="blog" id="delete_selected_blog">
            <?php
            $blogs = scandir("../blogs/");
            foreach ($blogs as $blog) {
                if (strlen($blog) >= 3 && substr($blog, -3) == ".md") {
                    $blog = substr($blog, 0, -3);
                    echo "<option value='$blog'>$blog</option>";
                }
            }
            ?>
                </select>
            </p>
            <a class="button" id="delete_get_posts">GET POSTS</a>
        </section>

        <!-- Media Upload -->
        <section class="card">
            <div class="headline">Media Upload</div>
            <form enctype="multipart/form-data" action="media/" method="POST">
                <input type="hidden" name="MAX_FILE_SIZE"
                    value="100000000000"/>
                <input id="" name="userfile" type="file" value="Choose a file"/>
                <br><br>
                <input id="button" type="submit" value="Upload" class="button"/>
            </form>
        </section>

        <!-- Atom Feed Generator -->
        <section class="card">
            <div class="headline">Atom Feed Generator</div>
            <p>
                <select name="blog" id="generate_atom_blog">
            <?php
            $blogs = scandir("../blogs/");
            foreach ($blogs as $blog) {
                if (strlen($blog) >= 3 && substr($blog, -3) == ".md") {
                    $blog = substr($blog, 0, -3);
                    echo "<option value='$blog'>$blog</option>";
                }
            }
            ?>
                </select>
            </p>
            <a class="button" id="generate_atom">GENERATE</a>
        </section>

        <?php
        } else {
        ?>

        <!-- Wrong Password -->
        <section class="card">
            <div class="headline">Wrong Password</div>
            <p>
                Please go back and try again.
            </p>
            <a href="./" class="button">GO BACK</a>
        </section>

<?php
        }
    }
} else {
?>

        <!-- Not enabled -->
        <section class="card">
            <div class="headline">Rangitaki Control Center</div>
            <p>
                The Rangitaki Control Center is disabled. You can enable
                it in your config file. But please read first the
                documentation.
            </p>
        </section>
<?php
}
?>

        <!-- Back -->
        <section class="card" id="back-card">
            <div class="headline">Back</div>
            <p>Go back to your blog.</p>
            <a href="../" class="button">GO BACK</a>
        </section>
    </div>
    <script src="./res/rcc.js"></script>
    <script src="../res/js/jquery-2.1.4.min.js"></script>
    <script src="./res/delete.js"></script>
    <script src="./res/edit.js"></script>
    <script src="./res/atom.js"></script>
</body>
</html>
