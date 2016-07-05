<?php

namespace JWorksUK\Mondo\FeedItems;

class FeedItemTest extends \PHPUnit_Framework_TestCase
{
    protected $feeditem;

    public function setUp()
    {
        $this->feeditem = new FeedItem('ttit', 'http://www.w3schools.com');
    }

    public function colorProvider()
    {
        return [
            ['#fff'],
            ['#FFFFFF'],
            ['#6600fF']
        ];
    }

    /**
     * @expectedException \LogicException
     */
    public function testSetTitleString()
    {
        $feeditem = new FeedItem([], 'http://www.google.com');
    }

    /**
     * @expectedException \LogicException
     */
    public function testSetImageUrlUrl()
    {
        $feeditem = new FeedItem('Title', []);
    }

    /**
     * @expectedException \LogicException
     */
    public function testBackgroundColorFalse()
    {
        $feeditem = new FeedItem('Title', 'http://www.google.com', '#phptests');
    }

    public function testToArray()
    {
        $this->assertArrayHasKey('title', $this->feeditem->toArray());
    }

    /**
     * @dataProvider colorProvider
     */
    public function testIsHexColour($color)
    {
        $this->assertTrue($this->feeditem->isHexColour($color));
    }

    public function testIsHexColourFalse()
    {
        $this->assertFalse($this->feeditem->isHexColour('#gkgfls'));
    }
}
