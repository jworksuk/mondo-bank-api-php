<?php

namespace JWorksUK\Mondo\Models;

class Transactions
{
    public $accounts = [];

    /**
     * Builds array of Transactions
     *
     * @param array $body
     */
    public function __construct(array $body)
    {
        if (isset($body->transactions)) {
            foreach ($body->transactions as $transaction) {
                $this->transactions[] = new Transaction($transaction);
            }
        }
    }
}
