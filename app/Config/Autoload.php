<?php

namespace App\Config {

    /**
     * ----------------------------------------------------------------------------
     * The Autoload Library is a PSR-4 compatible utility class that assists in
     * loading of package classmaps and namespaces
     * ----------------------------------------------------------------------------
     *
     * @author  Jason Napolitano
     * @version 1.0.0
     * @license MIT https://mit-license.org/
     */
    class Autoload
    {
        /**
         * PSR4 namespace array. All namespaces are in key => value pairs where
         * the key is the namespace and the value is the directory to the files
         * in that namespace
         *
         * EXAMPLE:
         * public static array $psr4 = [
         *     'NamespaceName" => __DIR__ . '/path/to/directory'
         * ]
         *
         * @var array $psr4
         */
        public static array $psr4 = [
            'ThirdParty' => APPPATH . 'ThirdParty',
        ];

        /**
         * All classmaps are in key => value pairs where the key is the
         * class name and the value is the path to the file containing
         * that class
         *
         * EXAMPLE:
         * public static array $classmap = [
         *     // With .php extension
         *     'ClassName" => __DIR__ . '/path/to/ClassName.php'
         *
         *     // Without .php extension
         *     'ClassName" => __DIR__ . '/path/to/ClassName'
         * ]
         *
         * @var array $classmap
         */
        public static array $classmap = [
            // ...
        ];
    }
}
