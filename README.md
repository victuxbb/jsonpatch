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
or inside your root project directory

``` bash

$ composer require victuxbb/jsonpatch @stable

```

Documentation
-------------
With a target JSON like this:
``` php
$targetJSON ='{"baz": "qux","foo": "bar"}';
```
and a variable with a JSON string operations:
``` php
$patchOperations = '[
     { "op": "replace", "path": "/baz", "value": "boo" }
   ]';
```
create a instance of Patcher and use the "patch" method to get the json result:

``` php
$patcher = new Patcher();
$result = $patcher->patch($targetJSON,$patchOperations);
```
$result will contain:
``` json
{"baz":"boo","foo":"bar"}
```

Thanks to
---------

*https://github.com/webnium

*https://github.com/javadegava

*http://williamdurand.fr/2014/02/14/please-do-not-patch-like-an-idiot/

*http://www.groupalia.com/
