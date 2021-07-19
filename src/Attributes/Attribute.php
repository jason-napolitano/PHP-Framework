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
    class Attribute
    {
        /** @var int Skip function arguments on the specified position */
        public const ANY_ARGUMENT = 1;

        // --------------------------------------------------------------------

        /**
         * Attribute constructor
         *
         * @param string $implements Interface(s) implemented?
         * @param string $inherited  Inherited by a parent?
         * @param string $namespace  Namespace for script?
         * @param string $copyright  Copyright information
         * @param string $container  Script container
         * @param string $requires   Requirements for script
         * @param string $replaces   Replaces which script?
         * @param string $replaced   Replaced by which script?
         * @param string $instead    Script to use instead?
         * @param string $comment    A collection of comments
         * @param string $license    License information
         * @param string $extends    Extends which class?
         * @param string $version    Script version
         * @param string $updated    Updated on
         * @param string $service    Service location?
         * @param string $package    Package information
         * @param string $author     Script author
         * @param string $parent     Parent class?
         * @param string $child      Child class?
         * @param string $since      Since which version/date/time?
         * @param string $route      Routes to X
         * @param string $link       Relevant link
         * @param string $type       Type of value?
         * @param string $uses       Uses which script
         * @param string $use        Use instead of
         * @param string $see        Relevant script
         * @param string $to         Routes to where?
         */
        public function __construct(
            string $implements = '',
            string $inherited = '',
            string $namespace = '',
            string $copyright = '',
            string $container = '',
            string $requires = '',
            string $replaces = '',
            string $replaced = '',
            string $instead = '',
            string $comment = '',
            string $license = '',
            string $extends = '',
            string $version = '',
            string $updated = '',
            string $service = '',
            string $package = '',
            string $author = '',
            string $parent = '',
            string $child = '',
            string $since = '',
            string $route = '',
            string $link = '',
            string $type = '',
            string $uses = '',
            string $use = '',
            string $see = '',
            string $to = '',
        )
        { /* ... */
        }
    }
}
