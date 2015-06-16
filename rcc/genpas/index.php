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
        <link rel="stylesheet" href="../res/rcc.css" />
    </head>
    <body>
        <div class="header">
            <a href="../" class="title">Rangitaki Control Center</a>
        </div>
        <div class="main">
            <section class="card">
                <div class="headline">Password Generator</div>
                <?php
                if ($_POST['passwd'] == "") {
                    ?>
                    <form action="./" method="post">
                        <p>New password:<br><br><input type="password" class="itextfield" name="passwd"/></p>
                        <input type="submit" value="Get password" class="button"/>
                    </form>
                    <?php
                } else {
                    echo "<p style='word-wrap: break-word;'>" . password_hash($_POST['passwd'], PASSWORD_DEFAULT) . "</p>";
                }
                ?>
            </section>
        </div>
    </body>
</html>
