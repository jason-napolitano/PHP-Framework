<?php

namespace Exceptions\Helpers {

    use ReflectionClass;
    use Exceptions\Exception;

    /**
     * ExceptionHelpers Trait
     *
     * A simple trait that should assist in throwing specific exceptions
     * from within classes
     *
     * @package Exceptions\Helpers
     *
     * @author  Jason Napolitano <https://github.com/jason-napolitano>
     * @version 0.0.3
     * @since   0.0.1
     * @license MIT <https://opensource.org/licenses/MIT>
     */
    trait ExceptionHelpers
    {
        /**
         * Throw a custom error. NOTE that this class must live within the
         * \Exceptions namespace OR it must extend \Exception
         *
         * If the class does not live within the \Exceptions namespace or does
         * not extend \Exception, \Exception is thrown instead
         *
         * @param string      $message   The message body for the exception
         * @param string|null $exception The optional exception class to use
         */
        public static function throwError(string $message, string $exception = null): void
        {
            // Create a new ReflectionClass instance
            $reflectionClass = new ReflectionClass($exception);

            // If the class passed into $exception is !not null ...
            if ( $exception !== null ) {

                // If $exception lives within the \Exceptions namespace OR
                // extends \Exception
                if ( $reflectionClass->getNamespaceName() === '\Exceptions' ||
                    is_subclass_of($exception, \Exception::class)
                ) {
                    // Throw a new $exception with its corresponding $message
                    throw new $exception($message);
                }
            }

            // If none of the above apply, throw an \Exceptions\Exception using $message
            // as the exceptions message body
            throw new Exception($message);
        }
    }
}
