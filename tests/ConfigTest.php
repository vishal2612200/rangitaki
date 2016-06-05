<?php

namespace mmk2410\rbe\tests\config;

require_once 'PHPUnit/Autoload.php';
require 'res/php/Config.php';

use \mmk2410\rbe\config\Config as Config;

class ConfigTest extends \PHPUnit_Framework_TestCase
{

    public function testGetConfig()
    {
        $config = [
            "blog" => array(
                "title" => "Example Blog",
                "author" => "John",
                "description" => "A short description of your blog",
                "home" => "on",
                "homeurl" => "../",
                "homename" => "Home",
                "mainname" => "",
                "intro" => "on",
                "disqus" => "rangitaki",
                "analytics" => "",
                "footer" =>
                "Rangitaki 2016 <a href=\"https://gitlab.com/mmk2410/rangitaki\" target=\"blank\">\n    gitlab.com/mmk2410/rangitaki</a>", "url" => "https://example.com/blog/",
            ),
            "design" => array(
                "fab" => "on",
                "drawer" => "on",
                "theme" => "material-light",
                "pagination" => 0,
                "favicon" => "http://example.com/res/img/favicon.png",
            ),
            "rcc" => array(
                "rcc" => "on",
                "api" => "on",
            ),
            "language" => "en",
        ];

        $configParser = new Config("./config.yaml", "./vendor/autoload.php");
        $this->assertEquals($config, $configParser->getConfig());
    }

    public function testWriteReadConfig()
    {
        $changedConfig = [
            "blog" => array(
                "title" => "Examples Blog",
                "author" => "Wilson O'Sullivan",
                "description" => "A long description of your blog",
                "home" => "on",
                "homeurl" => "../",
                "homename" => "Exit",
                "mainname" => "",
                "intro" => "on",
                "disqus" => "",
                "analytics" => "",
                "footer" =>
                "pBlog 1102 <a href=\"https://gitlab.com/mmk2410/rangitaki\" target=\"blank\">
                \n    gitlab.com/mmk2410/rangitaki</a>", "url" => "https://example.com/blog/",
            ),
            "design" => array(
                "fab" => "off",
                "drawer" => "off",
                "theme" => "material-dark",
                "pagination" => "-1",
                "favicon" => "http://sample.com/res/img/favicon.png",
            ),
            "rcc" => array(
                "rcc" => "on",
                "api" => "off",
            ),
            "language" => "en",
        ];
        $configParser = new Config("/tmp/config-test.yaml", "./vendor/autoload.php");
        $configParser->writeConfig($changedConfig);
        $this->assertEquals($changedConfig, $configParser->getConfig());
    }
}
