<?php

namespace Core\Services\Session {

    // IMPORTS ----------------------------------------------------------------
    use Countable;
    use Stringable;
    use JsonSerializable;

    /**
     * ------------------------------------------------------------------------
     * The Session Library Class is a utility wrapper class that assists in the
     * handling of sessions in PHP applications. We achieve this by creating an
     * abstraction between the developer and PHP's native session library. Thus
     * providing a factory that can manufacture, modify and manage session data
     * ------------------------------------------------------------------------
     *
     * @author  Jason Napolitano
     * @license MIT https://mit-license.org
     * @package Core\Services\Session
     * @version 1.1.4
     */
    class Session implements SessionInterface, Countable, JsonSerializable, Stringable
    {
        /**
         * Was an existing session already killed by calling session_destroy()?
         *
         * @link https://www.php.net/manual/en/function.session-destroy.php
         *
         * @see  session_destroy()
         *
         * @var bool $destroyed
         */
        protected bool $destroyed = false;

        /**
         * ----------------------------------------------------------
         * The Session Service Class Constructor will build us a
         * session object that interacts directly with PHP's
         * native session SPL's and $_SESSION variables
         *
         * @link  https://www.php.net/manual/en/reserved.variables.session.php
         *
         * @param bool $autoStart Run session_start() when instantiating
         *                        this class?
         *
         * @return void
         */
        public function __construct(protected bool $autoStart = true)
        {
            if ( $this->autoStart ) $this->start();
        }

        // ----------------------------------------------------------

        /**
         * Initialize session data, but only if $autoStart is set to
         * FALSE (to void calling session_start() more than once)
         *
         * @link https://php.net/manual/en/function.session-start.php
         *
         * @return void
         */
        public function start(): void
        {
            if ( ! $this->autoStart ) session_start();
        }

        // ----------------------------------------------------------

        /**
         * Calls session_write_close() to write session data and
         * end the session
         *
         * @link https://php.net/manual/en/function.session-write-close.php
         *
         * @return void
         */
        public function close(): void
        {
            session_write_close();
        }

        // ----------------------------------------------------------

        /**
         * Calls session_register_shutdown() which will register
         * session_write_close() as a shutdown function
         *
         * @link https://php.net/en/functions.session-register-shutdown.php
         */
        public function shutdown(): void
        {
            session_register_shutdown();
        }

        // ----------------------------------------------------------

        /**
         * Destroys all data registered to a session
         *
         * @link https://php.net/manual/en/function.session-destroy.php
         *
         * @return void
         */
        public function destroy(): void
        {
            $this->destroyed = true;
            session_destroy();
        }

        // ----------------------------------------------------------

        /**
         * Removes data from $_SESSION
         *
         * @param string|array|null $keys The session key(s) to use
         *
         * @return void
         */
        public function remove(string|array|null $keys = null): void
        {
            // If self::destroy() hasn't been called ...
            if ( ! $this->destroyed ) {
                // ... And, if $keys is a string ...
                if ( is_string($keys) ) {
                    // ... unset the value of $keys
                    unset($_SESSION[$keys]);
                }

                // Else, if $keys is an array ...
                if ( is_array($keys) ) {
                    // ... unset each matching value within $keys
                    foreach ( $keys as $key ) {
                        unset($_SESSION[$key]);
                    }
                }

                // If all else fails, we want to unset the entire
                // $_SESSION array
                $this->unset();
            }
        }

        // ----------------------------------------------------------

        /**
         * Unsets the entire $_SESSION array
         */
        protected function unset(): void
        {
            // Reset $_SESSION completely by setting
            // it to an empty array
            $_SESSION = [];
        }

        // ----------------------------------------------------------

        /**
         * Adds a key => value pair to the $_SESSION array
         *
         * @param string            $key The key to store in $_SESSION
         * @param string|array|null $val The value to assign to $key
         *
         * @return void
         */
        public function set(string $key, string|array|null $val = null): void
        {
            // Take $key and add it to $_SESSION, then assign
            // $value to $key
            $_SESSION[$key] = $val;
        }

        // ----------------------------------------------------------

        /**
         * Get a value from $_SESSION. If $key is NULL, a string
         * representation of $_SESSION will be returned instead
         *
         * @param string|null $key
         *
         * @return array|string|null
         */
        public function get(string $key = null): array|string|null
        {
            // If $key is !not NULL and $key is a string, return its value.
            // Else, return $this to to be parsed by __toString()
            return ! is_null($key) && is_string($key) ? $_SESSION[$key] : $this;
        }

        // ----------------------------------------------------------
        // ++ Countable implementation

        /**
         * Returns the total number of values stored in $_SESSION
         *
         * @link   https://www.php.net/manual/en/class.countable.php
         *
         * @return int
         */
        public function count(): int
        {
            // Return the total number of values in $_SESSION
            return count($_SESSION);
        }

        // ----------------------------------------------------------
        // ++ Stringable implementation

        /**
         * Returns the value of the $_SESSION array as a string
         *
         * @link   https://www.php.net/manual/en/class.stringable.php
         *
         * @return string
         */
        public function __toString(): string
        {
            // Return $_SESSION as a string, delineated by
            // commas. EG - "value_1, value_2, value_3..."
            return implode(', ', $_SESSION);
        }

        // ----------------------------------------------------------
        // ++ JsonSerializable implementation

        /**
         * Returns the $_SESSION array to be serialized by json_encode()
         * or an empty array if $_SESSION isn't set or it's NULL
         *
         * @link   https://www.php.net/manual/en/class.jsonserializable.php
         *
         * @return array
         */
        public function jsonSerialize(): array
        {
            return $_SESSION ?? [];
        }
    }
}
