<?php

namespace JWorksUK\Mondo\Models;

use JWorksUK\Mondo\Helper;

class Account
{
    public $id;

    public $description;

    public $created;

    /**
     * Create a new Instance
     *
     * @param object $account
     */
    public function __construct($account)
    {
        if (isset($account->id)
            && isset($account->description)
            && isset($account->created)
        ) {
            $this->id = $account->id;
            $this->description = $account->description;
            $this->created = Helper::createDateTime(
                Helper::MONDO_DATETIME,
                $account->created
            );
        }
    }

    /**
     * Get account ID
     *
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get account description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Get date account was created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created->format(Helper::APP_DATETIME);
    }
}
