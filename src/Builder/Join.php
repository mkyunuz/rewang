<?php

namespace Mkyunuz\Rewang\Builder;

use Mkyunuz\Rewang\Abstracts\BaseJArrayManipulation;
use Mkyunuz\Rewang\Contract\JArrayInterface;
use Mkyunuz\Rewang\Contract\MapAndJoinInterface;
use Mkyunuz\Rewang\Traits\MapAndJoinTrait;

class Join extends BaseJArrayManipulation implements JArrayInterface, MapAndJoinInterface
{
    use MapAndJoinTrait;

    private $keyResource;

    private $keyExtra;
    
    private $lookups;

    public function resolve(): JArrayInterface
    {
        $this->lookups();
        return $this;
    }

    private function lookups()
    {
        $this->lookups = array_column($this->extraArray, null, $this->keyResource);
        return $this;
    }

    public function compare(callable $callback)
    {
        $field = $this->keyExtra ? $this->keyExtra : $this->keyResource;
        $result = array_map(function($item) use($field, $callback)  {
            $find = isset($this->lookups[$item[$field]]) ? $this->lookups[$item[$field]] : []; 
            $value = $callback($item, $find);
            if(is_array($value)) {
                if($this->isAssoc($value)) {
                    $item = array_merge($item, $value);
                } 
            }
            return $item;
        }, $this->resources);
        $this->result = $result;
        return $this;

    }

   

    
}