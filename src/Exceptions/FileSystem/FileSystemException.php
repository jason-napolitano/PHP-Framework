<?php

namespace Exceptions\FileSystem;

use Exceptions\DomainException;

/**
 * FileSystemException class
 *
 * A base class for more generic file system related exceptions
 * to extend
 *
 * @package Exceptions\FileSystem
 *
 * @author  Jason Napolitano <https://github.com/jason-napolitano>
 * @version 0.0.3
 * @since   0.0.1
 * @license MIT <https://opensource.org/licenses/MIT>
 */
class FileSystemException extends DomainException
{
    /**
     * The exception message
     *
     * @var string $message The exception message
     */
    protected $message = 'A file system error was encountered';
}
