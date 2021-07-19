<?php

namespace Core\Services\Utilities {
    /**
     * ScriptManager
     *
     * @package Core\Debug
     */
    abstract class ScriptManager
    {
        /**
         * A way to stop script execution absolutely
         *
         * @param int $code
         *
         * @return void
         */
        public static function killAll(int $code = 0): void
        {
            exit($code);
        }
    }
}
