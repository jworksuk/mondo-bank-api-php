<?php

namespace JWorksUK\Mondo\Models;

use Iterator;

class Collection implements Iterator
{
    private $data = [];

    private $class;

    public function __construct($data, $namespace, $class)
    {
        if (isset($data->{$namespace})) {
            $this->data = $data->{$namespace};
        }

        $this->class = $class;
    }

    public function rewind()
    {
        reset($this->data);
    }

    public function current()
    {
        $data = current($this->data);
        return new $this->class($data);
    }

    public function key()
    {
        $data = key($this->data);
        return new $this->class($data);
    }

    public function next()
    {
        $data = next($this->data);
        return new $this->class($data);
    }

    public function valid()
    {
        $key = key($this->data);
        $data = ($key !== null && $key !== false);
        return $data;
    }
}
