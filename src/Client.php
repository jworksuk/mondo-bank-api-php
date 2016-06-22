<?php

namespace JWorksUK\Mondo;

use GuzzleHttp\Client as GClient;
use GuzzleHttp\Psr7\Request;

/**
 * @todo  setClient() method
 */
class Client
{
    protected $client;

    protected $access_token;

    /**
     * Builds Mondo Client class
     *
     * @param string $access_token user's access token
     */
    public function __construct($access_token)
    {
        $this->setAccessToken($access_token);

        $this->client = new GClient(
            [
                'base_uri' => 'https://api.getmondo.co.uk',
                'headers' => [
                    'Authorization' => 'Bearer '.$this->access_token
                ]
            ]
        );
    }

    public function setAccessToken($access_token)
    {
        $this->access_token = $access_token;
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
            $response = $this->client->send($request, $options);

            $body = $response->getBody();
        } catch (\Exception $e) {
            throw new \Exception($e->getMessage(), $e->getCode());
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
     * @return Models\Accounts
     */
    public function listAccounts()
    {
        $response = $this->request('GET', '/accounts');

        return new Models\Accounts($response);
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
            '/balance',
            [
                'query' => [
                    'account_id' => $account_id
                ]
            ]
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
     * @return Models\Transactions
     */
    public function listTransactions($account_id)
    {
        $response = $this->request(
            'GET',
            '/transactions',
            [
                'query' => [
                    'account_id' => $account_id
                ]
            ]
        );

        return new Models\Transactions($response);
    }
}
