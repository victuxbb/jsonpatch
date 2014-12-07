<?php

namespace victuxbb\JsonPatch;

use Webnium\JsonPointer\ArrayAccessor;
use Webnium\JsonPointer\Parser;

/*
** TODO Refactor DRY
*/
class PatchOperations implements PatchOperationsInterface {

	
    private $object;
    private $jsonPointer;

    public function __construct(&$object)
    {
        $this->object = &$object;        
        $this->jsonPointer = new ArrayAccessor(new Parser);
    }

    public function add($operation)
    {
        $this->jsonPointer->set($operation->path,$this->object,$operation->value);
    }
   
    public function remove($operation)
    {
    	$this->jsonPointer->set($operation->path,$this->object,null);
    }

    public function replace($operation)
    {        
        $this->jsonPointer->set($operation->path,$this->object,$operation->value);        
    }
    
    public function move($operation)
    {
        $valueFrom = $this->jsonPointer->get($operation->from,$this->object);  
        $this->jsonPointer->set($operation->path,$this->object,$valueFrom);

        $this->jsonPointer->set($operation->from,$this->object,null);
    
    }
    
    public function copy($operation)
    {
        $valueFrom = $this->jsonPointer->get($operation->from,$this->object);  
        $this->jsonPointer->set($operation->path,$this->object,$valueFrom);
    }
    /**
	* TODO implement suggested errors in http://tools.ietf.org/html/rfc5789#section-2.2
    **/
    public function test($operation)
    {
        
    }

}