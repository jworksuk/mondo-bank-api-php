<?php

namespace JWorksUK\Mondo;

use JWorksUK\Mondo\Exceptions\HttpException;
use Http\Client\HttpClient;
use GuzzleHttp\Psr7\Request;
use Exception;

/**
 * @todo  setClient() method
 */
class Client
{
    protected $client;

    /**
     * Builds Mondo Client class
     *
     * @param string $access_token user's access token
     */
    public function __construct(HttpClient $client)
    {
        $this->client = $client;
    }

    public function setHttpClient(HttpClient $client)
    {
        $this->client = $client;
    }

    /**
     * Makes request to client
     *
     * @param string $method
     * @param string $endpoint
     * @param array  $options
     *
     * @todo  Better Exceptions
     *
     * @return object
     */
    public function request($method, $endpoint, array $options = [])
    {
        try {
            $request = new Request($method, $endpoint);
            $response = $this->client->sendRequest($request, $options);

            $body = $response->getBody();
        } catch (Exception $e) {
            $body = json_decode($e->getResponse()->getBody());
            throw new HttpException($body->message, $e->getCode());
        }

        return json_decode($body);
    }

    /**
     * To get information about an access token.
     *
     * @see https://getmondo.co.uk/docs/#authenticating-requests
     *
     * @return stdClass
     */
    public function whoAmI()
    {
        $response = $this->request('GET', '/ping/whoami');

        return $response;
    }

    /**
     * List of accounts of user.
     *
     * @see https://getmondo.co.uk/docs/#accounts
     *
     * @return Models\Collection
     */
    public function listAccounts()
    {
        $response = $this->request('GET', '/accounts');

        return new Models\Collection($response, 'accounts', Models\Account::class);
    }

    /**
     * Reads balance information for a specific account.
     *
     * @param string $account_id
     *
     * @see https://getmondo.co.uk/docs/#read-balance
     *
     * @return Models\Balance
     */
    public function readBalance($account_id)
    {
        $response = $this->request(
            'GET',
            '/balance?account_id='.$account_id
        );

        return new Models\Balance($response);
    }

    /**
     * List of transactions on the user’s account.
     *
     * @param string $account_id
     *
     * @see https://getmondo.co.uk/docs/#list-transactions
     *
     * @return Models\Collection
     */
    public function listTransactions($account_id)
    {
        $response = $this->request(
            'GET',
            '/transactions?account_id='.$account_id
        );

        return new Models\Collection($response, 'transactions', Models\Transaction::class);
    }

    /**
     * Returns an individual transaction, fetched by its id.
     *
     * @param  string $transaction_id
     * @param  string  $expand
     *
     * @see https://getmondo.co.uk/docs/#retrieve-transaction
     *
     * @return Models\Transaction
     */
    public function retrieveTransaction($transaction_id, $expand = '')
    {
        $response = $this->request(
            'GET',
            '/transactions/'.$transaction_id,
            [
                'query' => [
                    'expand[]' => $expand
                ]
            ]
        );

        return new Models\Transaction($response);
    }

    /**
     * Annotate transaction
     *
     * @param  string   $transaction_id
     * @param  Metadata $metadata
     *
     * @see https://getmondo.co.uk/docs/#annotate-transaction
     *
     * @return Models\Transaction
     */
    public function annotateTransaction($transaction_id, Metadata $metadata)
    {
        $response = $this->request(
            'PATCH',
            '/transactions/'.$transaction_id,
            [
                'form_params' => [
                    'metadata' => $metadata->toArray()
                ]
            ]
        );

        return new Models\Transaction($response);
    }

    /**
     * Creates a new feed item on the user’s feed
     *
     * @param  string             $account_id
     * @param  FeedItems\FeedItem $item
     *
     * @see https://getmondo.co.uk/docs/#create-feed-item
     *
     * @return boolean
     */
    public function createFeedItem($account_id, FeedItems\FeedItem $item)
    {
        $response = $this->request(
            'POST',
            '/feed',
            [
                'form_params' => [
                    'account_id' => $account_id,
                    'type' => 'basic',
                    'params' => $item->toArray()
                ]
            ]
        );

        return true;
    }
}
