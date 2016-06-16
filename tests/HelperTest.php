<?php

namespace JWorksUK\Mondo;

class HelperTest extends \PHPUnit_Framework_TestCase
{
    public function mondeyProvider()
    {
        return [
            [250, 'en_GB', '£2.50'],
            [1023357, 'en_US', '$10,233.57'],
            [250, 'fr_FR', '2,50 Eu'],
            [2000000, 'ja_JP', '¥20,000'],
        ];
    }

    /**
     * @dataProvider mondeyProvider
     */
    public function testFormatMoney($unit, $locale, $expect)
    {
        $this->assertEquals($expect, Helper::formatMoney($unit, $locale));
    }

    public function testCreateDateTime()
    {
        $data = Helper::createDateTime(Helper::MONDO_DATETIME, '2015-08-22T12:20:18.123Z');

        $this->assertInstanceOf(\DateTime::class, $data);
    }
}
