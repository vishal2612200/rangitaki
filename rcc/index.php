<!DOCTYPE html>
<!--
The MIT License

Copyright 2015 mmk.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Rangitaki Control Center</title>
        <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
        <link rel="stylesheet" href="./res/rcc.css" />
    </head>
    <body>
        <div class="header">
            <a href="./" class="title">Rangitaki Control Center</a>
        </div>
        <div class="main">
            <?php
            include '../config.php';
            if ($rcc == "yes") {
                if ($_POST['passwd'] == "") {
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
                    chmod("passwd.txt", 0644);
                    $hash = file_get_contents("passwd.txt");
                    chmod("passwd.txt", 0000);
                    if (password_verify($_POST['passwd'], $hash)) {
                        ?>
                        <section class="card">
                            <div class="headline">File Upload</div>
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
                                <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
                                <input id="" name="userfile" type="file" value="Choose a file" />
                                <br>
                                <br>
                                <input id="button" type="submit" value="Upload" class="button"/>
                            </form>
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
                ?>
                <section class="card">
                    <div class="headline">Password</div>
                    <p>
                        Generate a new password.
                    </p>
                    <a class="button" href="./genpas/">
                        GENERATOR
                    </a>
                </section>
                <?php
            } else {
                ?>
                <section class="card">
                    <div class="headline">Rangitaki Control Center</div>
                    <p>
                        The Rangitaki Control Center is disabled. You can enable it in your config file. But please read first the documentation.
                    </p>
                </section>
                <?php
            }
            ?>
        </div>
    </body>
</html>
