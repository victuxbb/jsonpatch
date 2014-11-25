<?php

namespace victuxbb\JsonPatch;

use Symfony\Component\PropertyAccess\PropertyAccess;

class PatchOperations implements PatchOperationsInterface {

	
    private $object;
    private $accessor;

    public function __construct($object)
    {
        $this->object = $object;        
        $this->accessor = PropertyAccess::createPropertyAccessor();
    }

    /**
	* TODO
    **/
    public function add()
    {

    }

    /**
	* TODO
    **/
    public function remove()
    {
    	
    }

    public function replace($path,$value)
    {        
        $attribute = explode("/",$path);
        $attribute = $attribute[1];        
        $this->accessor->setValue($this->object,$attribute,$value);
    }
    /**
	* TODO
    **/
    public function move()
    {

    }
    /**
	* TODO
    **/
    public function copy()
    {

    }
    /**
	* TODO
    **/
    public function test()
    {
        
    }

}