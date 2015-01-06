<?php
/**
 * Created by PhpStorm.
 * User: victux
 * Date: 8/12/14
 * Time: 1:33
 */

namespace victuxbb\JsonPatch\Tests;


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

        $targetJSON ='{
            "foo": {
              "bar": "baz",
              "waldo": "fred"
            },
            "qux": {
              "corge": "grault"
            }
          }';
        $patchOperations = '[
             { "op": "replace", "path": "/foo/waldo", "value": "boo" }
           ]';
        $expected ='{"foo":{"bar":"baz","waldo":"boo"},"qux":{"corge":"grault"}}';

        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);
    }
    
    public function testRemoveOperation()
    {
        $targetJSON ='{"baz": "qux","foo": "bar"}';
        $patchOperations = '[
            { "op": "remove", "path": "/baz" }
          ]';
        $expected ='{"foo":"bar"}';

        $patcher = new Patcher();
        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);
        
        $targetJSON ='{"foo":["bar","qux","baz"]}';
        $patchOperations = '[
            { "op": "remove", "path": "/foo/1" }
          ]';
        $expected ='{"foo":["bar","baz"]}';

        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);        
    }
    
    /*public function testMoveOperation()
    {
        $targetJSON ='{
            "foo": {
              "bar": "baz",
              "waldo": "fred"
            },
            "qux": {
              "corge": "grault"
            }
          }';
        $patchOperations = '[
            { "op": "move", "from": "/foo/waldo", "path": "/qux/thud" }
          ]';
        $expected ='{"foo":{"bar":"baz"},"qux":{"corge":"grault","thud":"fred"}}';

        $patcher = new Patcher();
        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);
        
        
        $targetJSON ='{"foo":["all","grass","cows","eat"]}';
        $patchOperations = '[
            { "op": "move", "from": "/foo/1", "path": "/foo/3" }
          ]';
        $expected ='{"foo":["all","cows","eat","grass"]}';

        $result = $patcher->patch($targetJSON,$patchOperations);
        $this->assertEquals($expected, $result);
        
        
    }*/

}