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
        <title>Rangitaki Upload</title>
    </head>
    <body>
        <?php
            include '../config.php';
            if($post_upload == "yes"){
                if($_POST['passwd'] == ""){
        ?>
        <form action="./" method="post">
            <p>Password: <input type="password" name="passwd"/></p>
            <input type="Submit" value="Log in"/>
        </form>
        <?php
                } else {
                    chmod("passwd.txt", 0644);
                    $hash = file_get_contents("passwd.txt");
                    chmod("passwd.txt", 0000);
                    if(password_verify($_POST['passwd'], $hash)){
        ?>
        <form enctype="multipart/form-data" action="uploaded/" method="POST">
            <select name="blog">
                <?php
                    $blogs = scandir("../blogs/");
                    foreach ($blogs as $blog) {
                        if(strlen($blog) >= 3 && substr($blog, -3) == ".md"){
                            $blog = substr($blog, 0, -3);
                            echo "<option value='$blog'>$blog</option>";
                        }
                    }
                ?>
            </select>
            <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
            <input id="" name="userfile" type="file" value="Choose a file" />
            <input id="button" type="submit" value="Upload" />
        </form>
        <?php
                    } else {
                        echo "Wrong password";
                    }
                }
            } else {
                echo "Post upload is disabled.";
            }
        ?>
    </body>
</html>
