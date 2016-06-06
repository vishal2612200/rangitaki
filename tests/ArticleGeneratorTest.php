<?php

require_once 'PHPUnit/Autoload.php';
include 'res/php/ArticleGenerator.php';

class ArticleGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetArray()
    {
        $result = [
            "title" => "The Rangitaki logo 2",
            "date" => "24 July 2015",
            "tags" => array(
                "design", "artwork", "logo",
            ),
            "author" => "",
            "text" => "
This is the official Rangitaki logo.

![The Rangitaki logo](media/example.png)

It is saved in the example blog directory.
",
        ];

        $this->assertEquals(
            $result,
            ArticleGenerator::getArray("articles/example/", "2015-07-25-example.md")
        );
    }

    public function testGetText()
    {
        $result = "
This is the official Rangitaki logo.

![The Rangitaki logo](media/example.png)

It is saved in the example blog directory.
";
        $this->assertEquals(
            $result,
            ArticleGenerator::getText("articles/example/", "2015-07-25-example.md")
        );
    }

    public function testGetAuthor()
    {
        $result = "";
        $this->assertEquals(
            $result,
            ArticleGenerator::getAuthor("articles/example/", "2015-07-25-example.md")
        );
    }

    public function testGetSummary()
    {
        $result = "This is the official Rangitaki logo.";
        $this->assertEquals(
            $result,
            ArticleGenerator::getSummary("articles/example/", "2015-07-25-example.md")
        );
    }

    public function testGetTags()
    {
        $result = [ "design", "artwork", "logo" ];
        $this->assertEquals(
            $result,
            ArticleGenerator::getTags("articles/example/", "2015-07-25-example.md")
        );
    }

    public function testGetDate()
    {
        $result = "24 July 2015";
        $this->assertEquals(
            $result,
            ArticleGenerator::getDate("articles/example/", "2015-07-25-example.md")
        );
    }

    public function testGetTitle()
    {
        $result = "The Rangitaki logo 2";
        $this->assertEquals(
            $result,
            ArticleGenerator::getTitle("articles/example/", "2015-07-25-example.md")
        );
    }
}
