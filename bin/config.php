<?php
// Marcel Kapfer (mmk2410)
// Script for moving from config.php to config.yaml
// License: MIT

require 'res/php/Config.php';

require 'config.php';

use mmk2410\rbe\config\Config as Config;

if ($bloghome == "yes") {
    $bloghome = "on";
}

if ($blogintro == "yes") {
    $blogintro = "on";
}

if ($sharefab == "yes") {
    $sharefab = "on";
}

if ($rcc == "yes") {
    $rcc = "on";
}

if ($nav_drawer == "yes") {
    $nav_drawer = "on";
}

$yaml = array(
    "blog" => array(
        "title" => $blogtitle,
        "author" => $blogauthor,
        "description" => $blogdescription,
        "home" => $bloghome,
        "homeurl" => $bloghomeurl,
        "homename" => $bloghomename,
        "mainname" => $blogmainname,
        "intro" => $blogintro,
        "disqus" => $blogdisqus,
        "analytics" => $bloganalytics,
        "footer" => $blogfooter,
        "url" => $blogurl
    ),
    "design" => array(
        "fab" => $sharefab,
        "drawer" => $nav_drawer,
        "theme" => $theme,
        "pagination" => $pagination,
        "favicon" => $favicon,
    ),
    "rcc" => array(
        "rcc" => "off",
        "api" => "off",
    ),
    "language" => $language,
);

$config = new Config('config.yaml', 'vendor/autoload.php');

if ($config->writeConfig($yaml)) {
    echo "YAML config saved.\nYou can delete the config.php file\n";
} else {
    echo "Failed to save YAML config.";
}
