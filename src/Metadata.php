<?php

namespace JWorksUK\Mondo;

class Metadata
{
    private $data = [];

    /**
     * Get Metadata
     *
     * @param string|int $key
     *
     * @return mixed
     */
    public function get($key)
    {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }

        return false;
    }

    /**
     * Set Metadata
     *
     * @param string|int $key
     * @param mixed      $value
     *
     * @return mixed
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;

        return $this->get($key);
    }

    /**
     * Return array of class
     *
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}
