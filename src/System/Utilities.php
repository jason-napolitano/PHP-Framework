<?php

namespace Core\System {

    use ReflectionMethod;
    use ReflectionProperty;

    /**
     * ----------------------------------------------------------------------------
     * The Utilities class is a class that can be used for implementing common
     * utility functions across your application
     * ----------------------------------------------------------------------------
     *
     * @package Core\HTTPConfig
     */
    class Utilities
    {
        /**
         * Load a method or property from a class
         *
         * @param string $class The class to search in
         * @param string $value The value to search for
         *
         * @return mixed        The value of $value from $class
         *
         * @throws \ReflectionException
         */
        public static function loadFromClass(string|object $class, string $value): mixed
        {
            if ( method_exists($class, $value) ) {
                $reflectionMethod = new ReflectionMethod($class, $value);

                if ( $reflectionMethod->isStatic() ) {
                    return (new $class())::$value();
                }

                return (new $class())->$value();
            }
            if ( property_exists($class, $value) ) {
                $reflectionProperty = new ReflectionProperty($class, $value);

                if ( $reflectionProperty->isStatic() ) {
                    return (new $class())::$value;
                }

                return (new $class())->$value;
            }
            return null;
        }
    }
}
