<?php

namespace JWorksUK\Mondo\Models;

use JWorksUK\Mondo\Helper;
use BadMethodCallException;

abstract class Model
{
    /**
     * API data
     * @var array
     */
    private $data = [];

    /**
     * Create a new Instance
     *
     * @param object $balance
     */
    public function __construct($data)
    {
        // Transaction
        if (isset($data->transaction)) {
            $this->data = $data->transaction;
        } else {
            $this->data = $data;
        }
    }

    /**
     * Magic method to get property
     *
     * @param  string $name
     * @throws BadMethodCallException
     * @return mixed
     */
    public function __get($name)
    {
        if (property_exists($this->data, $name)) {
            return $this->data->{$name};
        }

        throw new BadMethodCallException('Undefined property: '.$name);
    }

    public function __isset($name)
    {
        return isset($this->data->{$name});
    }

    /**
     * Magic method to call function
     *
     * @param  string $name
     * @param  array $arguments
     *
     * @see  http://stackoverflow.com/questions/1993721/how-to-convert-camelcase-to-camel-case
     *
     * @throws BadMethodCallException
     *
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $money = ['balance', 'spend_today', 'amount', 'account_balance'];

        $date = ['created', 'settled'];

        // Get camel case property name
        $key = substr($name, 3);

        preg_match_all(
            '!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!',
            $key,
            $matches
        );

        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        $key = implode('_', $ret);

        if ($key == 'category') {
            return ucwords(str_replace('_', ' ', $this->{$key}));
        }

        if (in_array($key, $money) && isset($this->currency)) {
            return Helper::formatMoney($this->{$key}, $this->currency);
        } elseif (in_array($key, $date)) {
            if (empty($this->{$key})) {
                return false;
            }

            return Helper::createDateTime(
                Helper::MONDO_DATETIME,
                $this->{$key}
            )->format(Helper::APP_DATETIME);
        } elseif (isset($this->{$key})) {
            return $this->{$key};
        }

        throw new BadMethodCallException('The method '.$name.' does not exist.');
    }
}
