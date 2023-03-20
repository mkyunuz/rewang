<?php

namespace Mkyunuz\Rewang;

use Mkyunuz\Rewang\Builder\Join;
use Mkyunuz\Rewang\Builder\MapAndCombine;

class JArray
{

    public static function mapAndCombine(array $resorceArray, array $extraArray, $keyName, array $indexs, callable $callback = null)
    {
        $instance = new MapAndCombine();
        $instance->setResourceArray($resorceArray);
        $instance->setKeyName($keyName);
        $instance->setExtraArray($extraArray);
        $instance->setIndex($indexs);
        $instance->make();
        if(is_callable($callback)) {
            return $callback($instance->result(), $instance->getResource(), $instance->getExtraData());
        } else{

            return $instance->result();
        }
    }


    public static function join(callable $callback, array $resorceArray, array $extraArray, $keyName)
    {
        $instance = new Join();
        $instance->setResourceArray($resorceArray);
        $instance->setKeyName($keyName);
        $instance->setExtraArray($extraArray);
        $instance->make();
        $instance->compare($callback);
        return $instance->result();
    }


}