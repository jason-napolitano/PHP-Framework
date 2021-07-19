<?php
namespace Core\Services\API {

    interface JWTInterface
    {

        /**
         * Decode the JSON Web Token
         *
         * @param string      $jwt    The JWT
         * @param string|null $key    The secret key
         * @param bool        $verify Don't skip verification process
         *
         * @return  object|array The JWT's payload
         */
        public function decode(string $jwt, ?string $key = null, bool $verify = true): object|array;

        // ------------------------------------------------------------------------

        /**
         * Decode the JSON data
         *
         * @param string $input JSON string
         *
         * @return object|array Representation of JSON string
         */
        public function jsonDecode(string $input): object|array;

        // ------------------------------------------------------------------------

        /**
         * JSON Error Handler
         *
         * @see    \json_last_error()
         *
         * @link   http://php.net/manual/en/function.json-last-error.php
         *
         * @param int $errno An error number from json_last_error()
         *
         * @return void
         */
        public function handleJsonError(int $errno): void;

        // ------------------------------------------------------------------------

        /**
         * URL Safe Decoding
         *
         * @param string $input A base64 encoded string
         *
         * @return string A decoded string
         */
        public function urlSafeB64Decode(string $input): string;

        // ------------------------------------------------------------------------

        /**
         * Return an encrypted message
         *
         * @param string $msg    The message to sign
         * @param string $key    The secret key
         * @param string $method The signing algorithm
         *
         * @return string An encrypted message
         *
         * @throws \DomainException
         */
        public function sign(string $msg, string $key, string $method = 'HS256'): string;

        // ------------------------------------------------------------------------

        /**
         * Encode the JSON Web Token
         *
         * @param object|array $payload PHP object or array
         * @param string       $key     The secret key
         * @param string       $algo    The signing algorithm
         *
         * @return string A JWT
         *
         * @throws \DomainException
         */
        public function encode(object|array $payload, string $key, string $algo = 'HS256'): string;

        // ------------------------------------------------------------------------

        /**
         * URL Safe Encoding
         *
         * @param string $input Anything really
         *
         * @return string The base64 encode of what you passed in
         */
        public function urlSafeB64Encode(string $input): string;

        // ------------------------------------------------------------------------

        /**
         * Encode the JSON data
         *
         * @param object|array $input A PHP object or array
         *
         * @return string JSON representation of the PHP object or array
         *
         * @throws \DomainException
         */
        public function jsonEncode(mixed $input): string;
    }
}
