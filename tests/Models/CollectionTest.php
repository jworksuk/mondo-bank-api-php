<?php

namespace JWorksUK\Mondo\Models;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $collection;

    public function setUp()
    {
        $response = new \stdClass;
        $response->tests = [];

        $test = new \stdClass;
        $test->id = 'test';

        $response->tests[] = $test;

        $this->collection = new Collection($response, 'tests', Transaction::class);
    }

    public function testForeach()
    {
        foreach ($this->collection as $key => $transaction) {
            $this->assertEquals($key, $this->collection->key());
            $this->assertEquals('test', $transaction->getId());
        }
    }
}
