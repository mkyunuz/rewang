<?php

namespace Mkyunuz\Rewang\Abstracts;

use Mkyunuz\Rewang\Contract\JArrayInterface;

abstract class BaseJArrayManipulation implements JArrayInterface
{

    protected $result;
    abstract public function resolve() : JArrayInterface;

    public function make()
    {
        return $this->resolve();
    }

    public function result()
    {
        return $this->result;
    }

    protected function isAssoc(array $arr)
    {
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

}