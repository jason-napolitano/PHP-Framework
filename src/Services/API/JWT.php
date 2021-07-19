<?php

namespace Core\Services\API {

    // IMPORTS ----------------------------------------------------------------
    use Exceptions\DomainException;
    use Exceptions\UnexpectedValueException;

    /**
     * ------------------------------------------------------------------------
     * Library for a JSON Web Token implementation based on the JWT Spec
     * ------------------------------------------------------------------------
     *
     * @link     https://opensource.org/licenses/BSD-2-Clause
     *
     * Read about the JWT Specification Here
     * @link     https://tools.ietf.org/html/rfc7519
     * @license  2-clause BSD
     * @version  1.0.1 [major.minor.patch]
     * @since    1.0.0 [major.minor.patch]
     *
     * @category Libraries
     * @author   Jason Napolitano <jnapolitanoit@gmail.com>
     * @updated  10.11.2018
     *
     */
    class JWT implements JWTInterface
    {
        /**
         * Decode the JSON Web Token
         *
         * @param string      $jwt    The JWT
         * @param string|null $key    The secret key
         * @param bool        $verify Don't skip verification process
         *
         * @return  object|array The JWT's payload
         *
         * @throws \DomainException
         * @throws \UnexpectedValueException
         */
        public function decode(string $jwt, ?string $key = null, bool $verify = true): object|array
        {
            $tks = explode('.', $jwt);
            if ( count($tks) !== 3 ) {
                throw new UnexpectedValueException('Wrong number of segments');
            }
            [$headb64, $payloadb64, $cryptob64] = $tks;
            if ( null === ($header = $this->jsonDecode($this->urlSafeB64Decode($headb64))) ) {
                throw new UnexpectedValueException('Invalid segment encoding');
            }
            if ( null === $payload = $this->jsonDecode($this->urlSafeB64Decode($payloadb64)) ) {
                throw new UnexpectedValueException('Invalid segment encoding');
            }
            $sig = $this->urlSafeB64Decode($cryptob64);
            if ( $verify ) {
                if ( empty($header->alg) ) {
                    throw new DomainException('Empty algorithm');
                }
                if ( $sig !== $this->sign("$headb64.$payloadb64", $key, $header->alg) ) {
                    throw new UnexpectedValueException('Signature verification failed');
                }
            }
            return $payload;
        }

        // ------------------------------------------------------------------------

        /**
         * Decode the JSON data
         *
         * @param string $input JSON string
         *
         * @return object|array Representation of JSON string
         *
         * @throws \DomainException
         */
        public function jsonDecode(string $input): object|array
        {
            $obj = json_decode(json: $input, flags: JSON_THROW_ON_ERROR);
            if ( function_exists('json_last_error') && $errno = json_last_error() ) {
                $this->handleJsonError($errno);
            } else if ( $obj === null && $input !== 'null' ) {
                throw new DomainException('Null result with non-null input');
            }
            return $obj;
        }

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
         *
         * @throws \DomainException
         */
        public function handleJsonError(int $errno): void
        {
            $messages = [
                JSON_ERROR_DEPTH     => 'Maximum stack depth exceeded',
                JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
                JSON_ERROR_SYNTAX    => 'Syntax error, malformed JSON',
            ];
            throw new DomainException($messages[$errno] ?? 'Unknown JSON error: ' . $errno);
        }

        // ------------------------------------------------------------------------

        /**
         * URL Safe Decoding
         *
         * @param string $input A base64 encoded string
         *
         * @return string A decoded string
         */
        public function urlSafeB64Decode(string $input): string
        {
            $remainder = strlen($input) % 4;
            if ( $remainder ) {
                $padlen = 4 - $remainder;
                $input .= str_repeat('=', $padlen);
            }
            return base64_decode(strtr($input, '-_', '+/'));
        }

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
        public function sign(string $msg, string $key, string $method = 'HS256'): string
        {
            $methods = [
                'HS256' => 'sha256',
                'HS384' => 'sha384',
                'HS512' => 'sha512',
            ];
            if ( empty($methods[$method]) ) {
                throw new DomainException('Algorithm not supported');
            }
            return hash_hmac($methods[$method], $msg, $key, true);
        }

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
        public function encode(object|array $payload, string $key, string $algo = 'HS256'): string
        {
            $header = ['typ' => 'JWT', 'alg' => $algo];
            $segments = [];
            $segments[] = $this->urlSafeB64Encode($this->jsonEncode($header));
            $segments[] = $this->urlSafeB64Encode($this->jsonEncode($payload));
            $signing_input = implode('.', $segments);
            $signature = $this->sign($signing_input, $key, $algo);
            $segments[] = $this->urlSafeB64Encode($signature);
            return implode('.', $segments);
        }

        // ------------------------------------------------------------------------

        /**
         * URL Safe Encoding
         *
         * @param string $input Anything really
         *
         * @return string The base64 encode of what you passed in
         */
        public function urlSafeB64Encode(string $input): string
        {
            return str_replace('=', '', strtr(base64_encode($input), '+/', '-_'));
        }

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
        public function jsonEncode(mixed $input): string
        {
            $json = json_encode(value: $input, flags: JSON_THROW_ON_ERROR);
            if ( function_exists('json_last_error') && $errno = json_last_error() ) {
                $this->handleJsonError($errno);
            } else if ( $json === 'null' && $input !== null ) {
                throw new DomainException('Null result with non-null input');
            }
            return $json;
        }
    }
}
