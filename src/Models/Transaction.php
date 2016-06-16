<?php

namespace JWorksUK\Mondo\Models;

use JWorksUK\Mondo\Helper;

class Transaction
{
    public $id;

    public $description;

    public $amount = 0;

    public $currency;

    public $merchant = null;

    public $notes = '';

    public $updated;

    public $created;

    /**
     * Create a new Instance
     *
     * @todo  Add merchants and Metadata
     *
     * @param object $transaction
     */
    public function __construct($transaction)
    {

        if (isset($transaction->id)) {
            $this->id = $transaction->id;
        }

        if (isset($transaction->currency)) {
            $this->currency = $transaction->currency;
        }

        if (isset($transaction->amount)) {
            $this->amount = $transaction->amount;
        }

        if (isset($transaction->is_load)) {
            $this->is_load = $transaction->is_load;
        }

        if (isset($transaction->created)) {
            $this->created = Helper::createDateTime(
                Helper::MONDO_DATETIME,
                $transaction->created
            );
        }

        if (isset($transaction->updated)) {
            $this->updated = Helper::createDateTime(
                Helper::MONDO_DATETIME,
                $transaction->updated
            );
        }

        if (isset($transaction->settled)) {
            $this->settled = Helper::createDateTime(
                Helper::MONDO_DATETIME,
                $transaction->settled
            );
        }

        if (isset($transaction->description)) {
            $this->description = $transaction->description;
        }
    }

    /**
     * Get transaction ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get transaction description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get date transaction was created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created->format(Helper::APP_DATETIME);
    }
}
