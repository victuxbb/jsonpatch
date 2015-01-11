<?php

namespace victuxbb\JsonPatch\Model;



class Operation{


    private $op;

    private $path;

    private $value;

    private $from;

    public function __construct($op,$path,$value){

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

    public function getFrom()
    {
        return $this->from;
    }
}
