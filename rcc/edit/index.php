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
 * Edit page of RCC (Rangitaki Control Center)
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
date_default_timezone_set('UTC');
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

    <link rel="stylesheet" href="../res/rcc.css"/>

    <link href='//fonts.googleapis.com/css?family=Roboto:400,500,700,300,
            400italic,100,100italic,900' rel='stylesheet'
            type='text/css'> <!--Font-->

</head>

<body>
    <div class="header">
        <a href="../" class="title">Rangitaki Control Center</a>
    </div>
    <div class="main">
<?php
session_start();
if ($_SESSION['login']) {
    include_once "../../res/php/ArticleGenerator.php";
    $directory = "./../../articles/" . $_GET['blog'] . "/";
    $article = $_GET['post'] . ".md";
?>
        <!-- Edit Post -->
        <section class="card">

            <div class="headline">Edit Post</div>

            <p>Title:
                <br><br>
                <input type="text" class="itextfield"
                        value="<?php
                        echo ArticleGenerator::getTitle($directory, $article);
                        ?>" name="title" id="title"/>
            </p>

            <p>Date:
                <br><br>
                <input type="text" class="itextfield"
                        value="<?php
                        echo ArticleGenerator::getDate($directory, $article);
                        ?>" name="date" id="date"/>
            </p>

            <p>Author:
                <br><br>
                <input type="text" class="itextfield"
                        value="<?php
                        echo ArticleGenerator::getAuthor($directory, $article);
                        ?>" name="author" id="author"/>
            </p>

            <p>Tags:
                <br><br>
                <input type="text" class="itextfield"
                        value="<?php
                        $tags = "";
                        foreach (
                            ArticleGenerator::getTags($directory, $article)
                            as $tag) {
                            $tags = $tags . ', ' . $tag;
                        }
                        $tags = substr($tags, 2);
                        echo $tags;
                        ?>" name="tags" id="tags"/>
            </p>

            <p>Text:</p>
            <textarea class="itextarea" name="text" id="text">
                <?php
                echo ArticleGenerator::getText($directory, $article);
                ?>
            </textarea>

            <br><br>
            <a class="button" id="save_changes">SAVE CHANGES</a>

        </section>

        <!-- Go Back -->
        <section class="card">

            <div class="headline">Back</div>

            <p>
                Go back to the RCC home. All changes will be lost.
            </p>

            <a class="button" href="../">BACK</a>

        </section>
<?php
} else {
?>

        <!-- Access denied -->
        <section class="card">

            <div class="headline">Access denied</div>

            <p>
                The access to this area is not granted. Make sure you're logged
                in.
            </p>

            <a class="button" href="../">BACK</a>

        </section>

<?php
}
?>

    </div>

    <script>
        var getVariables = <?php echo json_encode($_GET); ?>;
    </script>
    <script src="../../res/js/jquery-2.1.4.min.js"></script>
    <script src="../res/rcc.js"></script>
    <script src="../res/edit.js"></script>
</body>
</html>
