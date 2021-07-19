<?php

namespace Core\Services {

    // IMPORTS ----------------------------------------------------------------
    use Core\Services\API\JWT;
    use Core\Services\Debug\Dump;
    use Core\Services\Parser\XML;
    use Core\Services\Parser\JSON;
    use Core\Services\Logger\Logger;
    use Core\Services\Session\Session;
    use Core\Services\API\JWTInterface;
    use Core\Services\HTTP\ResponseTrait;
    use Core\Services\Debug\DumpInterface;
    use Core\Services\Libraries\ShoppingCart;
    use Core\Services\FileSystem\FileHandler;
    use Core\Services\Parser\ParserInterface;
    use Core\Services\Utilities\ScriptManager;
    use Core\Services\Session\SessionInterface;
    use Core\Services\Libraries\ShoppingCartInterface;
    use Core\Services\FileSystem\FileHandlerInterface;

    /**
     * ------------------------------------------------------------------------
     * This container holds all of the frameworks services. Take note that each
     * of the methods here in this container class also have helper functions
     * located in src\System\Functions.php
     *
     * Example usage via this container and/or a helper function:
     *
     *  - Logger Service:
     *    - METHOD A: \App\Services::logger( ...args )
     *    - METHOD B: logger( ...args )
     * ------------------------------------------------------------------------
     *
     * @package  Core\Services
     *
     * @requires PHP 8.0
     */
    class Container
    {
        // ResponseTrait to use with respond(...)
        use ResponseTrait;

        /**
         * --------------------------------------------------------------------
         * method() service method
         * --------------------------------------------------------------------
         * USAGE:
         * $session = service('session');
         * $session->set('key', 'value');
         * echo $session->get('key');
         *
         * @param string $method
         *
         * @return mixed
         */
        public static function call(string $method): mixed
        {
            if ( method_exists(self::class, $method) ) {
                return self::$method();
            }
            return false;
        }

        /**
         * --------------------------------------------------------------------
         * session() service method
         * --------------------------------------------------------------------
         *
         * @param bool $autostart
         *
         * @return SessionInterface
         */
        public static function session(bool $autostart = true): SessionInterface
        {
            return new Session($autostart);
        }

        /**
         * --------------------------------------------------------------------
         * cart() service method
         * --------------------------------------------------------------------
         *
         * @return ShoppingCartInterface
         */
        public static function cart(): ShoppingCartInterface
        {
            return new ShoppingCart();
        }

        /**
         * --------------------------------------------------------------------
         * jwt() service method
         * --------------------------------------------------------------------
         *
         * @return JWT
         */
        public static function jwt(): JWTInterface
        {
            return new JWT();
        }

        /**
         * --------------------------------------------------------------------
         * logger() service method
         * --------------------------------------------------------------------
         *
         * @param string $message
         * @param string $type
         * @param string $channel
         *
         * @return void
         */
        public static function logger(string $message, string $type, string $channel = 'event'): void
        {
            $logger = new Logger(file: LOGFILE, channel: $channel);
            $type = strtolower($type);
            $logger->$type($message);
        }

        /**
         * --------------------------------------------------------------------
         * Shorthand alias for the dump() service method
         * --------------------------------------------------------------------
         *
         * @param mixed ...$args
         *
         * @return Dump
         */
        public static function dd(...$args): DumpInterface
        {
            return self::dump(...$args);
        }

        /**
         * --------------------------------------------------------------------
         * dump() service method
         * --------------------------------------------------------------------
         *
         * @param mixed ...$args
         *
         * @return Dump
         */
        public static function dump(...$args): DumpInterface
        {
            return new Dump(...$args);
        }

        /**
         * --------------------------------------------------------------------
         * Kills script execution, absolutely
         * --------------------------------------------------------------------
         *
         * @return void
         */
        public static function kill(): void
        {
            ScriptManager::killAll();
        }

        /**
         * --------------------------------------------------------------------
         * A parser instance to parse JSON and XML data
         * --------------------------------------------------------------------
         *
         * @param mixed  $data
         * @param string $format
         *
         * @return ParserInterface
         */
        public static function parser(mixed $data, string $format = 'json'): ParserInterface
        {
            switch ( $format ) {
                case 'json':
                default:
                    // Set the content type
                    self::setContentType();

                    // Parse and return the response
                    $parser = new JSON();
                    return $parser->parse($data);

                case 'xml':
                    // Set the content type
                    self::setContentType('xml');

                    // Parse and return the response
                    $parser = new XML();
                    return $parser->parse($data);
            }
        }

        /**
         * --------------------------------------------------------------------
         * A parser instance to parse JSON and XML data
         * --------------------------------------------------------------------
         *
         * @param string $path
         *
         * @return FileHandlerInterface
         */
        public static function fs(string $path): FileHandlerInterface
        {
            return new FileHandler($path);
        }
    }
}
