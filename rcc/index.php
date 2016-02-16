<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--
        Rangitaki Blogging Engine - RCC (Rangitaki Control Center)

        Copyright (c) 2016 by Marcel Kapfer (mmk2410)

        MIT License
    -->
    <title>Rangitaki Control Center</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <link rel="stylesheet" href="./res/rcc.css"/>
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
            <section class="card">
                <div class="headline">Log In</div>
                <form action="./" method="post">
                    <p>Password:<br><br><input type="password" class="itextfield" name="passwd"/></p>
                    <input type="Submit" class="button" value="Log in"/>
                </form>
            </section>
            <?php
        } else {
            if ($passwd == $password) {
                $_SESSION['login'] = true;
                include_once("./../res/php/BlogListGenerator.php");
                ?>
                <section class="card">
                    <div class="headline">Post Upload</div>
                    <form enctype="multipart/form-data" action="uploaded/" method="POST">
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
                        <br>
                        <br>
                        <input id="button" type="submit" value="Upload" class="button"/>
                    </form>
                </section>
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

                        <p>Title:<br><br><input type="text" class="itextfield" name="title"/></p>

                        <p>Date:<br><br><input type="text" class="itextfield" name="date"/></p>

                        <p>Author:<br><br><input type="text" class="itextfield" name="author"/></p>

                        <p>Tags:<br><br><input type="text" class="itextfield" name="tags"/></p>

                        <p>Text:</p>
                        <textarea class="itextarea" name="text"></textarea>
                        <br><br>
                        <input id="button" type="submit" value="Post" class="button"/>
                    </form>
                </section>
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
                <section class="card">
                    <div class="headline">Media Upload</div>
                    <form enctype="multipart/form-data" action="media/" method="POST">
                        <input type="hidden" name="MAX_FILE_SIZE" value="100000000000"/>
                        <input id="" name="userfile" type="file" value="Choose a file"/>
                        <br>
                        <br>
                        <input id="button" type="submit" value="Upload" class="button"/>
                    </form>
                </section>
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
        <section class="card">
            <div class="headline">Rangitaki Control Center</div>
            <p>
            The Rangitaki Control Center is disabled. You can enable it in 
            your config file. But please read first the documentation.
            </p>
        </section>
        <?php
    }
    ?>
    <section class="card" id="back-card">
        <div class="headline">Back</div>
        <p>
            Go back to your blog.
        </p>
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
