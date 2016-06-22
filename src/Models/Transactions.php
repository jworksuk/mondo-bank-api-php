<?php

namespace JWorksUK\Mondo\Models;

class Transactions
{
    public $transactions = [];

    /**
     * Builds array of Transactions
     *
     * @param $body
     */
    public function __construct($body)
    {
        if (isset($body->transactions)) {
            foreach ($body->transactions as $transaction) {
                $this->transactions[] = new Transaction($transaction);
            }
        }
    }
}
