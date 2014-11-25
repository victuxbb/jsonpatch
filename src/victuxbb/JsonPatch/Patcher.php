<?php

namespace victuxbb\JsonPatch;


use victuxbb\JsonPatch\Entity\Operation;
use victuxbb\JsonPatch\PatchOperations;
use JMS\Serializer\SerializerBuilder;
use Doctrine\Common\Collections\ArrayCollection;

class Patcher {

	/**
	 *	var object to insert data
	**/

	private $serializer;
	


	public function __construct()
	{
		$this->serializer = SerializerBuilder::create()
      ->addMetadataDir(__DIR__."/Serializer")
      ->build();
	}

  public function patch($jsonTargetObject,$jsonOperations)
  {
  	$operations = $this->serializer->deserialize($jsonOperations, 'ArrayCollection<victuxbb\JsonPatch\Entity\Operation>', 'json');
 		$object = json_decode($jsonTargetObject);
 		foreach ($operations as $operation) {
 			
 			$method_call = $operation->getOp();
 		 
 			$patchOperation = new PatchOperations($object);
 			$reflectionMethod = new \ReflectionMethod('victuxbb\JsonPatch\PatchOperations',$method_call);
		  $reflectionMethod->invokeArgs($patchOperation,array($operation->getPath(),$operation->getValue()));
 		 	
 		}   		

	  return json_encode($object);

  }

  public function containsReplace($json,$path)
  {
  	$operations = $this->serializer->deserialize($json, 'ArrayCollection<victuxbb\JsonPatch\Entity\Operation>', 'json');
 		
 		foreach ($operations as $operation) {
 			
 			if("replace" === $operation->getOp()) return true;
 		 	
 		}   		
	return false;
  }

}