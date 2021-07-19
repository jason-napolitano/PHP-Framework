<?php

namespace Attributes {

    use Attribute as BaseAttribute;

    /**
     * ----------------------------------------------------------------------------
     * NoReturn Attribute Attribute Class
     * ----------------------------------------------------------------------------
     *
     * @link     https://wiki.php.net/rfc/attributes
     *
     * @package  Attributes
     * @requires PHP >= v.8.0.0
     */
    #[BaseAttribute(
        BaseAttribute::TARGET_FUNCTION |
        BaseAttribute::TARGET_METHOD)
    ]
    class NoReturn
    {
        /**
         */
        public const ANY_ARGUMENT = 1;

        /**
         * NoReturn constructor
         *
         * @param ...$arguments
         */
        public function __construct(...$arguments)
        {
            // ...
        }
    }
}
