<?php
/**
 * This file is part of webnium/json-pointer.
 */

namespace victuxbb\JsonPatch\Exception;

/**
 * SyntaxError exception.
 *
 * This Exception will be thrown when a JSON Pointer has syntax error.
 */
class SyntaxError extends \RuntimeException implements ExceptionInterface
{
}
