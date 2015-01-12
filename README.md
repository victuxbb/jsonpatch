jsonpatch
=========

[![SensioLabsInsight](https://insight.sensiolabs.com/projects/dee95637-0141-4caa-b6bf-1189a848128c/big.png)](https://insight.sensiolabs.com/projects/dee95637-0141-4caa-b6bf-1189a848128c)

Implementation of JSON Patch (http://tools.ietf.org/html/rfc6902) in PHP

Installation
-------------
Require [`victuxbb/jsonpatch`](https://packagist.org/packages/victuxbb/jsonpatch)
into your `composer.json` file:

``` json
{
    "require": {
        "victuxbb/jsonpatch": "@stable"
    }
}
```

Documentation
-------------
``` php

$targetJSON ='{"baz": "qux","foo": "bar"}';
$patchOperations = '[
     { "op": "replace", "path": "/baz", "value": "boo" }
   ]';
$expected ='{"baz":"boo","foo":"bar"}';

$patcher = new Patcher();
$result = $patcher->patch($targetJSON,$patchOperations);

```

Thanks to
---------

*https://github.com/webnium

*https://github.com/javadegava

*http://williamdurand.fr/2014/02/14/please-do-not-patch-like-an-idiot/

*http://www.groupalia.com/
