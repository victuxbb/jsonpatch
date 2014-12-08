<?php

namespace victuxbb\JsonPatch;

use victuxbb\JsonPatch\ArrayAccessor;
use victuxbb\JsonPatch\Parser;


class PatchOperations implements PatchOperationsInterface {

	
    private $object;
    private $jsonPointer;
    private $parser;

    public function __construct(&$object,$operation)
    {
        $this->object = &$object;
        $this->parser = new Parser($operation->path,$this->object);
        $this->jsonPointer = new ArrayAccessor($this->parser);
    }

    public function add($operation)
    {
        if($this->parser->destinationIsLocationInArray($operation->path,$this->object)){
            $this->jsonPointer->insert($operation->path,$this->object,$operation->value);
        }else {
            $this->jsonPointer->set($operation->path, $this->object, $operation->value);
        }
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