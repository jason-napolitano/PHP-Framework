<?php

namespace Core\Services\Session {

    /**
     * Interface SessionInterface
     *
     * @package Core\Services\Session
     */
    interface SessionInterface
    {
        /**
         * Initialize session data, but only if $autoStart is set to
         * FALSE (to void calling session_start() more than once)
         *
         * @link https://php.net/manual/en/function.session-start.php
         *
         * @return void
         */
        public function start(): void;

        // ----------------------------------------------------------

        /**
         * Removes data from a session
         *
         * @param string|array|null $keys
         *
         * @return void
         */
        public function remove(string|array $keys = null): void;

        // ----------------------------------------------------------

        /**
         * Calls session_write_close() to write session data and
         * end the session
         *
         * @link https://php.net/manual/en/function.session-write-close.php
         *
         * @return void
         */
        public function close(): void;

        // ----------------------------------------------------------

        /**
         * Destroys all data registered to a session
         *
         * @link https://php.net/manual/en/function.session-destroy.php
         *
         * @return void
         */
        public function destroy(): void;

        // ----------------------------------------------------------

        /**
         * Set a value in the $_SESSION array
         *
         * @param string            $key The key to store in $_SESSION
         * @param string|array|null $val The value to assign to $key
         *
         * @return void
         */
        public function set(string $key, string|array|null $val = null): void;

        // ----------------------------------------------------------

        /**
         * Get a value from $_SESSION. If $key is NULL, a string
         * representation of $_SESSION will be return instead
         *
         * @param string|null $key
         *
         * @return array|string|null
         */
        public function get(string $key = null): array|string|null;
    }
}
