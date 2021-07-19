<?php
namespace Core\Services\Debug {

    interface DumpInterface
    {

        /**
         * Set backtrace offset.
         *
         * @param int $offset
         */
        public static function setTraceOffset(int $offset): void;

        /**
         * Force debug to use posix, (For window users who are using tools like
         * http://cmder.net/)
         *
         * @param mixed ...$args
         */
        public static function safe(...$args): void;

        // ------------------------------------------------------------------------

        /**
         * Updates color properties value.
         *
         * @param string $name
         * @param array  $value
         */
        public static function set(string $name, array $value): void;

        // ------------------------------------------------------------------------

        /**
         * Writes dump to console.
         *
         * @param $message
         */
        public function write(string $message): void;

        // ------------------------------------------------------------------------

        /**
         * Format string using ANSI escape sequences
         *
         * @param string      $string
         * @param string|null $format
         *
         * @return string
         */
        public function format(string $string, string $format = null): string;

        // ------------------------------------------------------------------------

        /**
         * Formats the data type.
         *
         * @param string $type
         * @param string $before
         *
         * @return string
         */
        public function type(string $type, string $before = ''): string;

        // ------------------------------------------------------------------------

        /**
         * Formats array elements.
         *
         * @param array $array
         * @param bool  $obj_call
         *
         * @return string
         */
        public function formatArray(array $array, bool $obj_call): string;

        // ------------------------------------------------------------------------

        /**
         * Formats array index.
         *
         * @param      $key
         * @param bool $parent
         *
         * @return string
         */
        public function arrayIndex(string $key, bool $parent = false): string;

        // ------------------------------------------------------------------------

        /**
         * Assert code nesting doesn't surpass specified limit.
         *
         * @return bool
         */
        public function aboveNestLevel(): bool;

        // ------------------------------------------------------------------------

        /**
         * Formats object property values.
         *
         * @param \ReflectionProperty $property
         * @param                     $object
         * @param string              $class_name
         *
         * @return string
         */
        public function getValue(\ReflectionProperty $property, $object, string $class_name): string;
    }
}
