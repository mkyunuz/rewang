<?php

namespace Mkyunuz\Rewang\Contract;

interface MapAndJoinInterface {

    public function setKeyName($keyName);
    
    public function setExtraArray(array $extraArray);
    
    public function setResourceArray(array $resources);
}