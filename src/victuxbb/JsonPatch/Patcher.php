<?php

namespace victuxbb\JsonPatch;


use victuxbb\JsonPatch\Entity\Operation;
use victuxbb\JsonPatch\PatchOperations;

class Patcher {

    public function __construct()
    {

    }

    public function patch($jsonTargetObject,$jsonOperations)
    {
        $operations = json_decode($jsonOperations);         
        $object = json_decode($jsonTargetObject,true);
        
        foreach ($operations as $operation) {
            
            $method_call = $operation->op;   
            $patchOperation = new PatchOperations($object);
            $reflectionMethod = new \ReflectionMethod('victuxbb\JsonPatch\PatchOperations',$method_call);
            $reflectionMethod->invoke($patchOperation,$operation);
            
        }           

        return json_encode($object);

    }
}