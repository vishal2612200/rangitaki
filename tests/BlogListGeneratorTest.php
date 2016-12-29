<?php

use PHPUnit\Framework\TestCase;

require 'res/php/BlogListGenerator.php';
use mmk2410\rbe\BlogListGenerator\BlogListGenerator as BlogListGenerator;

class BlogListGeneratorTest extends TestCase
{
    public function testListBlog()
    {
        $this->assertEquals("<a class='nav-item' href='./?blog=example'>Example</a>",
                            BlogListGenerator::listBlog("./blogs/", "example.md", "Example Blog")
        );
        $this->assertEquals("<a class='nav-item' href='https://mmk2410.org/rangitaki/docs/'>Docs</a>",
                            BlogListGenerator::listBlog("./blogs/", "external.md", "Example Blog")
        );
    }
    
    public function testGetName()
    {
        $this->assertEquals("Example", BlogListGenerator::getName("blogs/example.md"));
    }

    public function testGetArticleAmount()
    {
        $this->assertEquals(5, BlogListGenerator::getArticleAmount("example"));
    }

    public function testGetExternaleLink()
    {
        $this->assertEquals(null,
                            BlogListGenerator::getExternalLink("example.md", '.')
        );
        $this->assertEquals("https://mmk2410.org/rangitaki/docs/",
                            BlogListGenerator::getExternalLink("external.md", '.')
        );
    }
}
