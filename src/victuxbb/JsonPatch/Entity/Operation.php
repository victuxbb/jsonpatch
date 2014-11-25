<?php

namespace victuxbb\JsonPatch\Entity;



class Operation{


	private $op;

    private $path;

    private $value;

    public function _construct($op,$path,$value){

        $this->op = $op;
        $this->path = $path;
        $this->value = $value;

    }	

    public function getOp()
    {
        return $this->op;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getValue()
    {
        return $this->value;
    }   


}