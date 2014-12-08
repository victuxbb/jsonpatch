<?php
/**
 * Created by PhpStorm.
 * User: victuxbb
 * Date: 8/12/14
 * Time: 4:22
 */

namespace victuxbb\JsonPatch;

use Webnium\JsonPointer\ArrayAccessor as WebniumArrayAccessor;

class ArrayAccessor extends WebniumArrayAccessor
{
    /**
     * set pointed value in the location of an array
     *
     * @param string $pointer JSON Pointer string
     * @param array  &$array   target array
     * @param mixed  $value   value to set
     *
     * @throws Exception\SyntaxError
     * @throws Exception\NoneExistentValue
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     * @SuppressWarnings(PHPMD.EvalExpression)
     */
    public function insert($pointer, &$array, $value)
    {
        $pointerArray = $this->parser->parse($pointer);
        $total = count($pointerArray);
        $location = $pointerArray[$total -1];
        $sourceArray = $pointerArray[$total -2];

        $res = array_splice($array[$sourceArray],$location,0,$value);

        return $array;

    }

    public function remove($pointer, &$array, $value)
    {

    }


}