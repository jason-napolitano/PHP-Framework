<?php

namespace App\Config {

    /**
     * Class ContentTypes
     *
     * @package App\Config
     */
    class ContentTypes
    {
        /**
         * A collection of content types and their corresponding values
         *
         * @var array $formats A collection of commonly used content
         *                          types
         */
        public static array $formats = [
            'json' => 'application/json',
            'pdf'  => 'application/pdf',
            'xml'  => 'application/xml',
            'html' => 'text/html',
        ];
    }
}
