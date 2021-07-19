<?php

namespace Exceptions;

/**
 * UnexpectedValueException class
 *
 * This exception is thrown if a value does not match with a set of values.
 * Typically this happens when a function calls another function and expects
 * the return value to be of a certain type or value not including arithmetic
 * or buffer related errors.
 *
 * @package Exceptions
 *
 * @author  Jason Napolitano <https://github.com/jason-napolitano>
 * @version 0.0.3
 * @since   0.0.1
 * @license MIT <https://opensource.org/licenses/MIT>
 */
class UnexpectedValueException extends \UnexpectedValueException implements ExceptionInterface
{
    // ...
}
