<?php

namespace App\Config {

    /**
     * Class HTTP
     *
     * @package App\Config
     */
    class HTTP
    {
        /**
         * A collections of response codes and their corresponding text
         * values
         *
         * @var $code array[] Common HTTP responses codes and their
         *                    corresponding messages
         */
        public static array $codes = [
            // ------------------------------------------------------
            // 1xx: Informational
            HTTP_CONTINUE                                                  => 'Continue',
            HTTP_SWITCHING_PROTOCOLS                                       => 'Switching Protocols',
            HTTP_PROCESSING                                                => 'Processing',
            // ------------------------------------------------------
            // 2xx: Success
            HTTP_OK                                                        => 'OK',
            HTTP_CREATED                                                   => 'Created',
            HTTP_ACCEPTED                                                  => 'Accepted',
            HTTP_NON_AUTHORITATIVE_INFORMATION                             => 'Non-Authoritative Information',
            HTTP_NO_CONTENT                                                => 'No Content',
            HTTP_RESET_CONTENT                                             => 'Reset Content',
            HTTP_PARTIAL_CONTENT                                           => 'Partial Content',
            HTTP_MULTI_STATUS                                              => 'Multi-Status',
            HTTP_ALREADY_REPORTED                                          => 'Already Reported',
            HTTP_IM_USED                                                   => 'IM Used',
            // ------------------------------------------------------
            // 3xx: Redirection
            HTTP_MULTIPLE_CHOICES                                          => 'Multiple Choices',
            HTTP_MOVED_PERMANENTLY                                         => 'Moved Permanently',
            HTTP_FOUND                                                     => 'Found',
            HTTP_SEE_OTHER                                                 => 'See Other',
            HTTP_NOT_MODIFIED                                              => 'Not Modified',
            HTTP_USE_PROXY                                                 => 'Use Proxy',
            HTTP_RESERVED                                                  => 'Switch Proxy',
            HTTP_TEMPORARY_REDIRECT                                        => 'Temporary Redirect',
            HTTP_PERMANENTLY_REDIRECT                                      => 'Permanent Redirect',
            // ------------------------------------------------------
            // 4xx: Client error
            HTTP_BAD_REQUEST                                               => 'Bad Request',
            HTTP_UNAUTHORIZED                                              => 'Unauthorized',
            HTTP_PAYMENT_REQUIRED                                          => 'Payment Required',
            HTTP_FORBIDDEN                                                 => 'Forbidden',
            HTTP_NOT_FOUND                                                 => 'Not Found',
            HTTP_METHOD_NOT_ALLOWED                                        => 'Method Not Allowed',
            HTTP_NOT_ACCEPTABLE                                            => 'Not Acceptable',
            HTTP_PROXY_AUTHENTICATION_REQUIRED                             => 'Proxy Authentication Required',
            HTTP_REQUEST_TIMEOUT                                           => 'Request Timeout',
            HTTP_CONFLICT                                                  => 'Conflict',
            HTTP_GONE                                                      => 'Gone',
            HTTP_LENGTH_REQUIRED                                           => 'Length Required',
            HTTP_PRECONDITION_FAILED                                       => 'Precondition Failed',
            HTTP_REQUEST_ENTITY_TOO_LARGE                                  => 'Request Entity Too Large',
            HTTP_REQUEST_URI_TOO_LONG                                      => 'Request-URI Too Long',
            HTTP_UNSUPPORTED_MEDIA_TYPE                                    => 'Unsupported Media Type',
            HTTP_REQUESTED_RANGE_NOT_SATISFIABLE                           => 'Requested Range Not Satisfiable',
            HTTP_EXPECTATION_FAILED                                        => 'Expectation Failed',
            HTTP_I_AM_A_TEAPOT                                             => "I'm a teapot",
            HTTP_MISDIRECTED_REQUEST                                       => 'Misdirected Request',
            HTTP_UNPROCESSABLE_ENTITY                                      => 'Unprocessable Entity',
            HTTP_LOCKED                                                    => 'Locked',
            HTTP_FAILED_DEPENDENCY                                         => 'Failed Dependency',
            HTTP_RESERVED_FOR_WEBDAV_ADVANCED_COLLECTIONS_EXPIRED_PROPOSAL => 'Too Early',
            HTTP_UPGRADE_REQUIRED                                          => 'Upgrade Required',
            HTTP_PRECONDITION_REQUIRED                                     => 'Precondition Required',
            HTTP_TOO_MANY_REQUESTS                                         => 'Too Many Requests',
            HTTP_REQUEST_HEADER_FIELDS_TOO_LARGE                           => 'Request Header Fields Too Large',
            HTTP_UNAVAILABLE_FOR_LEGAL_REASONS                             => 'Unavailable For Legal Reasons',
            HTTP_CLIENT_CLOSED_REQUEST                                     => 'Client Closed Request',
            // ------------------------------------------------------
            // 5xx: Server error
            HTTP_INTERNAL_SERVER_ERROR                                     => 'Internal Server Error',
            HTTP_NOT_IMPLEMENTED                                           => 'Not Implemented',
            HTTP_BAD_GATEWAY                                               => 'Bad Gateway',
            HTTP_SERVICE_UNAVAILABLE                                       => 'Service Unavailable',
            HTTP_GATEWAY_TIMEOUT                                           => 'Gateway Timeout',
            HTTP_VERSION_NOT_SUPPORTED                                     => 'HTTP Version Not Supported',
            HTTP_VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL                      => 'Variant Also Negotiates',
            HTTP_INSUFFICIENT_STORAGE                                      => 'Insufficient Storage',
            HTTP_LOOP_DETECTED                                             => 'Loop Detected',
            HTTP_NOT_EXTENDED                                              => 'Not Extended',
            HTTP_NETWORK_AUTHENTICATION_REQUIRED                           => 'Network Authentication Required',
            HTTP_NETWORK_CONNECTION_TIMEOUT                                => 'Network Connect Timeout Error',
        ];
    }
}
