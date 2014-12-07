jsonpatch
=========

Implementation of JSON Patch (http://tools.ietf.org/html/rfc6902) in PHP using JSON Pointer from:

https://github.com/webnium/php-json-pointer

Currently still developing, in the next couple of days I will post documentation and some refactors.

Example of test.php

<?php

require 'vendor/autoload.php';

use victuxbb\JsonPatch\Patcher;

$patcher = new Patcher();

$targetJSON ='{"a":{"b":["c","d","e"]}}';

$patchDocument = '[
      {"op":"add", "path":"/a/d", "value":["a","b"]},
      {"op":"move", "path":"/a/c", "from":"/a/d"},      
      {"op":"copy", "path":"/a/e", "from":"/a/c"},      
      {"op":"replace", "path":"/a/e", "value":["a"]}      
    ]';

$result = $patcher->patch($targetJSON,$patchDocument);

print_r($result);

Thanks to:

https://github.com/webnium
https://github.com/javadegava
http://williamdurand.fr/2014/02/14/please-do-not-patch-like-an-idiot/
http://www.groupalia.com/
