<?php

namespace Attributes {

    use Attribute as BaseAttribute;

    /**
     * ----------------------------------------------------------------------------
     * Base Attribute Attribute Class
     * ----------------------------------------------------------------------------
     *
     * @link     https://wiki.php.net/rfc/attributes
     *
     * @package  Attributes
     * @requires PHP >= v.8.0.0
     */
    #[BaseAttribute(
        BaseAttribute::IS_REPEATABLE |
        BaseAttribute::TARGET_ALL
    )]
    class Requires
    {
        /** @var int Skip function arguments on the specified position */
        public const ANY_ARGUMENT = 1;

        public function __construct(
            string $version = '8.0.0',
        )
        { /* */
        }
    }
}
