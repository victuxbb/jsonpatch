<?php

namespace victuxbb\JsonPatch;

interface PatchOperationsInterface {

	
	public function add();
    public function remove();
    public function replace($path,$value);
    public function move();
    public function copy();
    public function test();

}