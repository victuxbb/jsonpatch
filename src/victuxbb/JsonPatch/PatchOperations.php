<?php

namespace victuxbb\JsonPatch;

use victuxbb\JsonPatch\JsonPointer;

class PatchOperations implements PatchOperationsInterface {

	
    private $object;
    private $jsonPointer;

    public function __construct($object)
    {
        $this->object = $object;        
        $this->jsonPointer = new JsonPointer($targetObject);
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

    public function replace($operation)
    {        
        $jp = $this->jsonPointer->setPointer($operation->path);
        
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