<?php

namespace Mkyunuz\Rewang\Traits;

use Mkyunuz\Rewang\Builder\Join;
use Mkyunuz\Rewang\Builder\MapAndCombine;

trait MapAndJoinTrait
{
    public $resources;

    public $extraArray;

    private $indexs;
    
    public function setResourceArray(array $resources)
    {
        $this->resources = $resources;
        return $this;
    }

    public function setExtraArray(array $extraArray)
    {
        $this->extraArray = $extraArray;
        return $this;
    }


    public function setKeyName($keyName) 
    {
        if(!is_string($keyName)) {
            if(!$this->isAssoc($keyName)) {
                throw new \Exception("key name must be string or associative array");
            }
        }
        if(is_string($keyName)) {
            $this->keyResource = $keyName;
        } else if($this->isAssoc($keyName)){
            $this->keyResource = key($keyName);
            $this->keyExtra = isset($keyName[$this->keyResource]) ? $keyName[$this->keyResource] : null;
            
        }
        
        return $this;
    }

    public function setIndex(array $indexs)
    {
        $this->indexs = $indexs;
        return $this;
    }

    public function getResource(){
        return $this->resources;
    }

    public function getExtraData()
    {
        return $this->extraArray;
    }

    public function collect($find, $key, $default)
    {
        return isset($find[$key]) ? $find[$key] : $default;
    }
    
}