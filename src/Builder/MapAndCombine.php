<?php

namespace Mkyunuz\Rewang\Builder;

use Mkyunuz\Rewang\Abstracts\BaseJArrayManipulation;
use Mkyunuz\Rewang\Contract\JArrayInterface;
use Mkyunuz\Rewang\Contract\MapAndJoinInterface;
use Mkyunuz\Rewang\Traits\MapAndJoinTrait;

class MapAndCombine extends BaseJArrayManipulation implements JArrayInterface, MapAndJoinInterface
{

    use MapAndJoinTrait;

    private $keyResource;

    private $keyExtra;
    
    private $lookups;

    public function resolve(): JArrayInterface
    {
        $this->lookups();
        $this->compare();
        return $this;
    }

    private function lookups()
    {
        $this->lookups = array_column($this->extraArray, null, $this->keyResource);
        return $this;
    }

    public function compare()
    {
        $field = $this->keyExtra ? $this->keyExtra : $this->keyResource;
        $result = array_map(function($item) use($field)  {
            $find = isset($this->lookups[$item[$field]]) ? $this->lookups[$item[$field]] : []; 
            foreach($this->indexs as $key => $default) {
                if(is_callable($default)) {
                    $item[$key] = $default($item, $find);
                } else {
                    $item[$key] = $this->collect($find, $key, $default);
                }
            }
            return $item;
        }, $this->resources);
        $this->result = $result;
        return $this;
        
    }
    
}