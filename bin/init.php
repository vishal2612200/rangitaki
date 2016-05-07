<?php
// Marcel Kapfer (mmk2410)
// PHP script for initializing Rangitaki
// MIT License

error_reporting(0);

require 'res/php/Config.php';

use mmk2410\rbe\config\Config as Config;

$config = new Config('config.yaml', 'vendor/autoload.php');

if (!file_exists('config.yaml')) {
    $yaml = array();
} else {
    $yaml = $config->getConfig();
}

// blog part
$yaml["blog"]["title"] = get("Title of your blog", $yaml["blog"]["title"], "Example Blog");
$yaml["blog"]["author"] = get("Your name:", $yaml["blog"]["author"], "John");
$yaml["blog"]["description"] = get("A description of your blog:", $yaml["blog"]["description"], "A short description of your blog");
$yaml["blog"]["home"] = getBool("Do you have a top site? (on/off)", $yaml["blog"]["home"], "on");
if ($yaml["blog"]["home"] == "on") {
    $yaml["blog"]["homeurl"] = get("Path / Url to home page", $yaml["blog"]["homeurl"], "../");
    $yaml["blog"]["homename"] = get("Name of your home page", $yaml["blog"]["homename"], "Home");
}
$yaml["blog"]["mainname"] = get("Name of the main blog (if empty, the blog title will be used)", "");
$yaml["blog"]["intro"] = getBool("Do you want a blog intro text? (on/off)", $yaml["blog"]["intro"], "on");
$yaml["blog"]["disqus"] = get("Your Disqus shortname (Leave empty to disable)", $yaml["blog"]["disqus"], "");
$yaml["blog"]["analytics"] = get("Google Analytics ID (Leave empty to disable)", $yaml["blog"]["analytics"], "");
$yaml["blog"]["footer"] = get("The footer of your blog", $yaml["blog"]["footer"], "Example Blog 2016 CC-BY-SA 4.0");

// design part
$yaml["design"]["fab"] = getBool("Would you like to use the share buttons (on/off)", $yaml["design"]["blog"], "on");
$yaml["design"]["drawer"] = getBool("Would you like the use the navigation drawer? (on/off)", $yaml["design"]["drawer"], "on");
$themes = getDir('./themes');
$yaml["design"]["theme"] = get("Which theme would you like to use? (" . $themes . ")", $yaml["design"]["theme"], "material-light");
$yaml["design"]["pagination"] =
    get("Which posts should be displayed on one page (0 to disable)", $yaml["design"]["pagination"], "0");
$yaml["design"]["favicon"] = get("URL to your favicon", $yaml["design"]["favicon"], "https://example.com/fav.ico");

// rcc
$yaml["rcc"]["rcc"] = "off";
$yaml["rcc"]["api"] = "off";

// languages
$langs = getDir('./lang');
$yaml["language"] = get("Choose a language (" . $langs . ")", $yaml["language"], "en");

$config->writeConfig($yaml);

function get($question, $value, $default)
{
    if (isset($value) && $value != "") {
        $input = readline($question . " (" . $value . "): ");
        if ($input == "") {
            return $value;
        } else {
            return $input;
        }
    } else {
        $input = readline($question . " (" . $default . ")" . ": ");
        if ($input == "") {
            return $default;
        } else {
            return $input;
        }
    }
}

function getBool($question, $value, $default)
{
    if (isset($value) && $value != "") {
        $input = "someval";
        while (!in_array($input, array("on", "off", ""))) {
            $input = readline($question . " (" . $value . "): ");
        }
        if ($input == "") {
            return $value;
        } else {
            return $input;
        }
    } else {
        $input = "";
        while (!in_array($input, array("on", "off"))) {
            $input = readline($question . " (" . $default . ")" . ": ");
        }
        if ($input == "") {
            return $default;
        } else {
            return $input;
        }
    }

}

function getDir($path)
{
    $dir = scandir($path, SCANDIR_SORT_DESCENDING);

    unset($dir[sizeof($dir) - 1]);
    unset($dir[sizeof($dir) - 1]);

    return implode(", ", $dir);
}
