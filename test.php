<?php

require 'vendor/autoload.php';

use victuxbb\JsonPatch\Patcher;

$patcher = new Patcher();

$targetJSON ='{"a":{"b":["c","d","e"]}}';

$patchDocument = '[
      {"op":"add", "path":"/a/d", "value":["a","b"]},       
      {"op":"remove", "path":"/a/d/b"},      
      {"op":"add", "path":"/a/d/-", "value":"b"},      
      {"op":"move", "path":"/a/c", "from":"/a/d"},      
      {"op":"copy", "path":"/a/e", "from":"/a/c"},      
      {"op":"replace", "path":"/a/e", "value":["a"]}      
    ]';

$result = $patcher->patch($targetJSON,$patchDocument);

print_r($result);