<?php

namespace Core\Services\HTTP {

    use App\Config\ContentTypes;

    /**
     * ----------------------------------------------------------------------------
     * Response Trait
     * ----------------------------------------------------------------------------
     *
     * @package Core\HTTP
     */
    trait ResponseTrait
    {
        /**
         * Send a response to the client
         *
         * @param array  $data
         * @param int    $code
         * @param string $format
         *
         * @return void
         */
        public static function response(array $data, int $code = null, string $format = 'json'): void
        {
            self::setStatusCode($code);
            echo parser($data, $format);
        }

        // ------------------------------------------------------------------------

        /**
         * Sets/gets the HTTP status code. If $code is NULL, this function will
         * return the currently assigned HTTP status code (EG: 200)
         *
         * @param int|null $code The HTTP status code to assign to the
         *                       native http_response_code() function.
         *
         * @return void
         */
        public static function setStatusCode(int $code = null): void
        {
            http_response_code($code ?? HTTP_OK);
        }

        // ------------------------------------------------------------------------

        /**
         * Sets the Content-Type header
         *
         * @param string $type
         *
         * @return void
         */
        public static function setContentType(string $type = 'json'): void
        {
            self::setHeader(key: 'Content-Type', value: ContentTypes::$formats[$type], replace: true);
        }

        // ------------------------------------------------------------------------

        /**
         * Assigns a value to PHP's native header() function
         *
         * @param string|int $key     The key portion of $header (EG: Content-Type)
         * @param string|int $value   The value of $key (EG: 'application/json')
         * @param int|null   $code    The optional status code [Default: 200]
         * @param bool       $replace Should the header replace a previous similar header
         *
         * @return void
         */
        final public static function setHeader(mixed $key, string|int $value, int $code = null, bool $replace = false): void
        {
            header("{$key}: {$value}", $replace, $code);
        }

        // ------------------------------------------------------------------------

        /**
         * Redirect to a URI/URL using PHP's native header() function
         *
         * @param string $to
         */
        public static function redirect(string $to): void
        {
            self::setHeader('Location', $to);
            exit;
        }

        // ------------------------------------------------------------------------

        /**
         *
         *
         * @return int
         */
        public function getStatusCode(): int
        {
            return http_response_code();
        }
    }
}
