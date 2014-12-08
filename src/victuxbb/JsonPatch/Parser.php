<?php
/**
 * Created by PhpStorm.
 * User: victux
 * Date: 8/12/14
 * Time: 3:29
 */

namespace victuxbb\JsonPatch;

use Webnium\JsonPointer\Parser as WebniumParser;
use Webnium\JsonPointer\Exception;
use Webnium\JsonPointer\ParserInterface;

class Parser extends WebniumParser implements ParserInterface
{
    /**
     * The elements of the JsonPointer
     * @var array
     */
    private $elements = array();
    /**
     * The number of elements in the JsonPointer
     * @var int
     */
    private $length;
    /**
     * Contains a Boolean for each property in $elements denoting whether this
     * element is an index. It is a property otherwise.
     * @var array
     */
    private $isIndex = array();

    public function __construct($pointer,$arrayTarget)
    {
        $this->elements = $this->parse($pointer);
        foreach($this->elements as $element){
            if(isset($arrayTarget[$element])) {
                $value = $arrayTarget[$element];
                if (is_array($value)) {
                    $this->isIndex[] = true;
                } else {
                    $this->isIndex[] = false;
                }
            }else{
                $this->isIndex[] = false;
            }

        }
        $this->length = count($this->elements);
        return $this->elements;
    }
    /*
     * An element to add to an existing array - whereupon the supplied
     * value is added to the array at the indicated location.
     */
    public function destinationIsLocationInArray()
    {
        if($this->length > 1){
            $lastElement = $this->elements[$this->length-1];
            if(is_numeric($lastElement) && $this->isIndex[$this->length-2]) return true;
        }
        return false;
    }



}