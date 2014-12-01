<?php

require 'vendor/autoload.php';

use victuxbb\JsonPatch\Patcher;

$patcher = new Patcher();

$targetJSON = '{"baz": "qux","foo": "bar"}';

$operations = '[
     { "op": "replace", "path": "/baz", "value": "boo" },
     { "op": "replace", "path": "/baz", "value": "caca" }
   ]';

$result = $patcher->patch($targetJSON,$operations);

print_r($result);