<?php

namespace JWorksUK\Mondo\Models;

class TransactionTest extends \PHPUnit_Framework_TestCase
{
    protected $transaction;

    public function setUp()
    {
        $object = new \stdClass;
        $object->account_balance = 13013;
        $object->amount = -510;
        $object->created = '2015-08-22T12:20:18.123Z';
        $object->currency = 'GBP';
        $object->description = 'THE DE BEAUVOIR DELI C LONDON        GBR';
        $object->id = 'tx_00008zIcpb1TB4yeIFXMzx';
        $object->merchant = '';
        $object->metadata = '';
        $object->notes = 'Salmon sandwich 🍞';
        $object->is_load = false;
        $object->settled = '2015-08-23T12:20:18.123Z';

        $this->transaction = new Transaction($object);
    }

    public function testGetId()
    {
        $this->assertEquals('tx_00008zIcpb1TB4yeIFXMzx', $this->transaction->getID());
    }

    public function testGetDescription()
    {
        $this->assertEquals('THE DE BEAUVOIR DELI C LONDON        GBR', $this->transaction->getDescription());
    }

    public function testGetCreated()
    {
        $this->assertEquals('2015-08-22 12:20:18', $this->transaction->getCreated());
    }

    public function testGetSettled()
    {
        $this->assertEquals('2015-08-23 12:20:18', $this->transaction->getSettled());
    }

    public function testGetNotes()
    {
        $this->assertEquals('Salmon sandwich 🍞', $this->transaction->getNotes());
    }

    public function testIsLoad()
    {
        $this->assertEquals(false, $this->transaction->getIsLoad());
    }

    public function testGetAmount()
    {
        $this->assertEquals('£ -5.10', $this->transaction->getAmount());
    }

    public function testGetAccountBalance()
    {
        $this->assertEquals('£ 130.13', $this->transaction->getAccountBalance());
    }
}
