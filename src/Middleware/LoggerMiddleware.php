<?php
namespace Core\Middleware {
    /**
     * LoggerMiddleware class
     *
     * @package App\Middleware
     */
    class LoggerMiddleware
    {
        public static function run(string $message = __CLASS__ . ' was called as a middleware.'): void
        {
            logger($message);
        }
    }
}
