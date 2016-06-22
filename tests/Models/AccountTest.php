<?php

namespace JWorksUK\Mondo\Models;

class AccountTest extends \PHPUnit_Framework_TestCase
{
    protected $account;

    public function setUp()
    {
        $object = new \stdClass;
        $object->id = 'TESTID';
        $object->description = 'TEST ACCOUNT';
        $object->created = '2015-08-22T12:20:18.123Z';

        $this->account = new Account($object);
    }

    public function testGetId()
    {
        $this->assertEquals('TESTID', $this->account->getID());
    }

    public function testGetDescription()
    {
        $this->assertEquals('TEST ACCOUNT', $this->account->getDescription());
    }

    public function testGetCreated()
    {
        $this->assertEquals('2015-08-22 12:20:18', $this->account->getCreated());
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testUndefinedProperty()
    {
        $this->account->foo;
    }

    /**
     * @expectedException \BadMethodCallException
     */
    public function testBadCallMethod()
    {
        $this->account->getFoo();
    }
}
