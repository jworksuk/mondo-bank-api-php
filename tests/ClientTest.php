<?php

namespace JWorksUK\Mondo;

use JWorksUK\Mondo\Client;
use Mockery as m;
use GuzzleHttp\Psr7\Response;

class ClientTest extends \PHPUnit_Framework_TestCase
{
    public function tearDown()
    {
        m::close();
    }

    public function setUp()
    {
        $this->httpclient = m::mock('\Http\Client\HttpClient');
        $this->client = new Client($this->httpclient);
    }

    public function testListAccounts()
    {
        $data = [
            'accounts' => [
                [
                    'id' => 'account_id',
                    'description' => 'A Name',
                    'created' => '2015-08-22T12:20:18.123Z',
                ]
            ]
        ];

        $this->httpclient
            ->shouldReceive('sendRequest')
            ->once()
            ->andReturn(new Response(200, [], json_encode($data)));
        $this->client->setHttpClient($this->httpclient);

        $accounts = $this->client->listAccounts();

        $this->assertInstanceOf(Models\Collection::class, $accounts);
        $this->assertCount(1, $accounts);
        $this->assertEquals('A Name', $accounts->current()->getDescription());
        $this->assertInstanceOf(Models\Account::class, $accounts->current());
    }

    public function testReadBalance()
    {
        $data = [
            'balance' => '12300',
            'currency' => 'GBP',
            'spend_today' => '-123',
        ];

        $this->httpclient
            ->shouldReceive('sendRequest')
            ->once()
            ->andReturn(new Response(200, [], json_encode($data)));
        $this->client->setHttpClient($this->httpclient);

        $balance = $this->client->readBalance('account_id');

        $this->assertInstanceOf(Models\Balance::class, $balance);
        $this->assertEquals('GBP', $balance->getCurrency());
    }

    public function testListTransactions()
    {
        $data = [
            'transactions' => [
                [
                    'id' => 'transaction_1',
                ],
                [
                    'id' => 'transaction_2',
                ],
                [
                    'id' => 'transaction_3',
                ],
                [
                    'id' => 'transaction_4',
                ],
                [
                    'id' => 'transaction_5',
                ]
            ]
        ];

        $this->httpclient
            ->shouldReceive('sendRequest')
            ->once()
            ->andReturn(new Response(200, [], json_encode($data)));
        $this->client->setHttpClient($this->httpclient);

        $transactions = $this->client->listTransactions('account_id');

        $this->assertInstanceOf(Models\Collection::class, $transactions);
        $this->assertCount(5, $transactions);
        $this->assertEquals('transaction_2', $transactions->next()->getId());
        $this->assertInstanceOf(Models\Transaction::class, $transactions->current());
    }

    public function testRetrieveTransaction()
    {
        $data = [
            'transaction' => [
                'id' => 'transaction_1',
            ]
        ];

        $this->httpclient
            ->shouldReceive('sendRequest')
            ->once()
            ->andReturn(new Response(200, [], json_encode($data)));
        $this->client->setHttpClient($this->httpclient);

        $transaction = $this->client->retrieveTransaction('transaction_id');

        $this->assertInstanceOf(Models\Transaction::class, $transaction);
        $this->assertEquals('transaction_1', $transaction->getId());
    }

    public function testAnnotateTransaction()
    {
        // $transaction = $this->client->annotateTransaction('transaction_id');
    }

    public function testCreateFeedItem()
    {
        // $feeditem = $this->client->createFeedItem('fakeaccount');
    }
}
