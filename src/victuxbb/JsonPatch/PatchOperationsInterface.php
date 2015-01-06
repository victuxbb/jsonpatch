<?php

namespace victuxbb\JsonPatch;

interface PatchOperationsInterface {

	
    public function add($operation);
    public function remove($operation);
    public function replace($operation);
    public function move($operation);
    public function copy($operation);
    public function test($operation);

}