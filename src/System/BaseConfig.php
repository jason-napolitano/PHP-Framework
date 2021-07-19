<?php

namespace Core\System {

    /**
     * Config class
     *
     * @package Core\System
     */
    class BaseConfig
    {
        /**
         * @param $name
         *
         * @return mixed
         */
        public function __get($name): mixed
        {
            return $this->$name;
        }

        // --------------------------------------------------------------------

        /**
         * @param $name
         * @param $value
         */
        public function __set($name, $value): void
        {
            $this->$name = $value ?? null;
        }

        // --------------------------------------------------------------------

        /**
         * @param $name
         *
         * @return bool
         */
        public function __isset($name): bool
        {
            return isset($this->$name);
        }

        // --------------------------------------------------------------------

        /**
         * @param $name
         */
        public function __unset($name): void
        {
            unset($this->$name);
        }
    }
}
