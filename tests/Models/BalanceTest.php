<?php

namespace JWorksUK\Mondo\Models;

class BalanceTest extends \PHPUnit_Framework_TestCase
{
    protected $account;

    public function setUp()
    {
        $object = new \stdClass;
        $object->balance = '12300';
        $object->currency = 'GBP';
        $object->spend_today = '-123';

        $this->account = new Balance($object);
    }

    public function testGetBalance()
    {
        $this->assertEquals('£ 123.00', $this->account->getBalance());
    }

    public function testGetSpendToday()
    {
        $this->assertEquals('£ -1.23', $this->account->getSpendToday());
    }

    public function testGetCurrency()
    {
        $this->assertEquals('GBP', $this->account->getCurrency());
    }
}
