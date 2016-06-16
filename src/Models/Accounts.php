<?php

namespace JWorksUK\Mondo\Models;

class Accounts
{
    public $accounts = [];

    /**
     * Builds array of Accounts
     *
     * @param array $body
     */
    public function __construct($body)
    {
        if (isset($body->accounts)) {
            foreach ($body->accounts as $account) {
                $this->accounts[] = new Account($account);
            }
        }
    }
}
