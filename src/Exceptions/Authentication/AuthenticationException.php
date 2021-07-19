<?php

namespace Exceptions\Authentication;

use Exceptions\DomainException;

/**
 * AuthenticationException class
 *
 * A base class for more generic authentication related exceptions
 * to extend
 *
 * @package Exceptions\Authentication
 *
 * @author  Jason Napolitano <https://github.com/jason-napolitano>
 * @version 0.0.3
 * @since   0.0.1
 * @license MIT <https://opensource.org/licenses/MIT>
 */
class AuthenticationException extends DomainException
{
    /**
     * The exception message
     *
     * @var string $message The exception message
     */
    protected $message = 'An authentication error was encountered';
}
