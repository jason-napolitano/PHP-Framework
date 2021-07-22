<?php

namespace App\Config {

    // IMPORTS ----------------------------------------------------------------
    use Core\System\BaseConfig;

    /**
     * App class
     *
     * @package App\Config
     */
    class App extends BaseConfig
    {
        /**
         * This is used when calling the base_url() function. The
         * .env file will be used before this variable, but setting
         * this to an empty string or NULL will override that value
         *
         * @var string $baseUrl
         */
        public static string $baseUrl = 'http://localhost:8080';
    }
}
