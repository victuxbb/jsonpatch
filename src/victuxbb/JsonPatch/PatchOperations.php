<?php

namespace victuxbb\JsonPatch;

use victuxbb\JsonPatch\JsonAccessor;
use victuxbb\JsonPatch\Exception\NoneExistentValue;

class PatchOperations implements PatchOperationsInterface {

	
    private $object;
    private $jsonPointer;
    private $parser;

    public function __construct(&$object,$operation)
    {
        $this->object = &$object;
        $this->parser = new JsonPointerParser($operation->path,$this->object);
        $this->jsonPointer = new JsonAccessor($this->parser);
    }

    public function add($operation)
    {           
        $this->jsonPointer->insert($this->parser->getElements(),$this->object,$operation->value);        
    }
   
    public function remove($operation)
    {
    	$this->jsonPointer->remove($this->parser->getElements(),$this->object);
    }

    public function replace($operation)
    {        
        $this->jsonPointer->set($this->parser->getElements(),$this->object,$operation->value);        
    }
    
    public function move($operation)
    {
        $elementsFrom = $this->parser->parse($operation->from);
        $valueFrom = $this->jsonPointer->get($elementsFrom,$this->object);        
        $this->jsonPointer->remove($elementsFrom,$this->object);
        $this->jsonPointer->insert($this->parser->getElements(),$this->object,$valueFrom);
    
    }
    
    public function copy($operation)
    {
        $valueFrom = $this->jsonPointer->get($operation->from,$this->object);  
        $this->jsonPointer->set($operation->path,$this->object,$valueFrom);
    }
    
    public function test($operation)
    {
        $valueFrom = $this->jsonPointer->get($operation->path,$this->object);
        $value = $operation->value;
        
        if($valueFrom === $value) return true;
        
        throw new NoneExistentValue('references none existent value.');
    }
}
