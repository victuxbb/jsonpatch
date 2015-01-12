<?php
/**
 * This file is part of webnium/json-pointer.
 */

namespace victuxbb\JsonPatch;

/**
 * Interface of JSON Pointer parser
 *
 */
interface JsonPointerParserInterface
{
    /**
     * parse json pointer
     *
     * @param string $pointer JSON Pointer to parse
     *
     * @return string[]
     * @throws Exception\SyntaxError
     * @throws Exception\NoneExistentValue
     */
    public function parse($pointer);
}
