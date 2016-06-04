<?php

require_once 'PHPUnit/Autoload.php';
include 'res/php/BlogListGenerator.php';

class BlogListGeneratorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetName()
    {
        $this->assertEquals("Example", BlogListGenerator::getName("blogs/example.md"));
    }

    public function testGetArticleAmount()
    {
        $this->assertEquals(5, BlogListGenerator::getArticleAmount("example"));
    }
}
