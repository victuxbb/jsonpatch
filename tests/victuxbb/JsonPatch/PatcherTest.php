<?php
/**
 * Created by PhpStorm.
 * User: victux
 * Date: 8/12/14
 * Time: 1:33
 */

namespace victuxbb\JsonPatch;


use \PHPUnit_Framework_TestCase as TestCase;
use victuxbb\JsonPatch\Patcher;


class PatcherTest extends TestCase
{


    public function testAddOperation()
    {
        $targetJSON ='{ "foo": "bar"}';
        $patchOperations = '[
         { "op": "add", "path": "/baz", "value": "qux" }
        ]';
        $expected ='{"foo":"bar","baz":"qux"}';

        $patcher = new Patcher();
        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);


        $targetJSON ='{ "foo": [ "bar", "baz" ] }';
        $patchOperations = '[
             { "op": "add", "path": "/foo/1", "value": "qux" }
           ]';
        $expected ='{"foo":["bar","qux","baz"]}';

        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);



    }

    public function testReplaceOperation()
    {

        $targetJSON ='{"baz": "qux","foo": "bar"}';
        $patchOperations = '[
             { "op": "replace", "path": "/baz", "value": "boo" }
           ]';
        $expected ='{"baz":"boo","foo":"bar"}';

        $patcher = new Patcher();
        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);


    }

}