<?php

namespace JWorksUK\Mondo;

class MetadataTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->metadata = new Metadata;
    }

    public function keyValueProvider()
    {
        return [
            ['name', 'Jesse James'],
            ['site', 'Google']
        ];
    }

    /**
     * @dataProvider keyValueProvider
     */
    public function testSet($key, $value)
    {
        $this->assertEquals($value, $this->metadata->set($key, $value));
    }

    public function testCreateDateTime()
    {
        $data = Helper::createDateTime(Helper::MONDO_DATETIME, '2015-08-22T12:20:18.123Z');

        $this->assertInstanceOf(\DateTime::class, $data);
    }

    public function testToArray()
    {
        $this->metadata->set('name', 'Jesse James');
        $this->assertArrayHasKey('name', $this->metadata->toArray());
    }

    public function testGetFalse()
    {
        $this->assertFalse($this->metadata->get('false'));
    }
}
