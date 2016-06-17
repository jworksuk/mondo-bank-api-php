<?php

namespace JWorksUK\Mondo;

class HelperTest extends \PHPUnit_Framework_TestCase
{
    public function mondeyProvider()
    {
        return [
            [250, 'GBP','£ 2.50'],
            [1023357, 'USD','$ 10,233.57'],
            [250, 'EUR', '€ 2.50'],
            [2000000, 'JPY', '¥ 20,000'],
        ];
    }

    /**
     * @dataProvider mondeyProvider
     */
    public function testFormatMoney($unit, $currency, $expect)
    {
        $this->assertEquals($expect, Helper::formatMoney($unit, $currency));
    }

    public function testCreateDateTime()
    {
        $data = Helper::createDateTime(Helper::MONDO_DATETIME, '2015-08-22T12:20:18.123Z');

        $this->assertInstanceOf(\DateTime::class, $data);
    }
}
