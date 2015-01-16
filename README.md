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
A typical use case with FOSRestBundle and JMSSerializer:
``` php
public function patchUserAction(Request $request,User $user)
    {            
        $json = $request->getContent();
        $jps = $this->get('json_patch_service'); //symfony service that loads Patcher.php
        $serializer = $this->get("jms_serializer");

        $serializerGroup = array('view');

        $sc = SerializationContext::create();
        $sc->setGroups($serializerGroup);

        $jsonUser = $serializer->serialize($user,'json',$sc); //Generating the json target of object that we want to update
        $jsonUser = $jps->patch($jsonUser,$json); //json result with the changes applied of the json operations

        $dc = DeserializationContext::create();
        $dc->setAttribute('target',$user);

        //Restore the doctrine entity object with deserialization and targeting the object with DeserializationContext
        $serializer->deserialize($jsonUser,'Groupalia\BizApiBundle\Entity\User','json',$dc);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        $response = new Response();
        $response->setStatusCode(200);
        
        return $response;

    }
```

Thanks to
---------

*https://github.com/webnium

*https://github.com/javadegava

*http://williamdurand.fr/2014/02/14/please-do-not-patch-like-an-idiot/

*http://www.groupalia.com/
