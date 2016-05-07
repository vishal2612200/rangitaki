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
 * Media page of RCC (Rangitaki Control Center)
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

        <section class="card">
            <div class="headline">File Upload</div>

<?php
session_start();

if ($_SESSION['login']) {
    if ($_FILES['userfile']['name'] == "") {
        echo "<p>You have to choose a file!</p>";
    } else {
        $uploaddir = "../../media/";
        $uploadfile = $uploaddir . basename($_FILES['userfile']['name']);

        if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
            echo
                "<p>
                The post was successfully uploaded and is now published.
                </p>";
        } else {
            echo
                "<p>During the uploading process an error occured! <br>
                Error Code:"
                . ($_FILES['userfile']['error'] . "</p>");
        }
    }
?>

            <a href="../" class="button">GO BACK</a>

<?php
}
?>

        </section>
    </div>
</body>
</html>
