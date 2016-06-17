<?php

namespace JWorksUK\Mondo\Models;

use JWorksUK\Mondo\Helper;

class Balance
{
    public $balance;

    public $currency;

    public $spend_today;

    /**
     * Create a new Instance
     *
     * @param object $balance
     */
    public function __construct($balance)
    {
        if (isset($balance->balance)
            && isset($balance->currency)
            && isset($balance->spend_today)
        ) {
            $this->balance = $balance->balance;
            $this->currency = $balance->currency;
            $this->spend_today = $balance->spend_today;
        }
    }

    /**
     * Get account ID
     *
     * @return string
     */
    public function getBalance()
    {
        return Helper::formatMoney($this->balance, $this->currency);
    }

    /**
     * Get account ID
     *
     * @return string
     */
    public function getSpendToday()
    {
        return Helper::formatMoney($this->spend_today, $this->currency);
    }
}
