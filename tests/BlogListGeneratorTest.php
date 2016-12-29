<?php

require_once 'PHPUnit/Autoload.php';

require_once 'res/php/BlogListGenerator.php';
use mmk2410\rbe\BlogListGenerator\BlogListGenerator as BlogListGenerator;

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
