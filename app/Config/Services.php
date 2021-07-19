<?php

namespace App\Config {

    // IMPORTS ----------------------------------------------------------------
    use Core\Services\Container as ServiceContainer;

    /**
     * ----------------------------------------------------------------------------
     * Service Container
     * ----------------------------------------------------------------------------
     * Any services that you want to implement can be placed here. Method overrides
     * are encouraged since not all methods within the Core Service Container are
     * final.
     *
     * Take note that each of the methods within the parent container class also
     * have helper functions located in src\System\Common.php
     *
     * Example usage via this container and/or a helper function:
     *
     *  - Logger Service:
     *    - METHOD A: \App\Services::logger( ...args )
     *    - METHOD B: logger( ...args )
     *
     * Example override of the logger service:
     *
     * public static function logger(string: $message, string: $type, string: $channel): LoggerInterface
     * {
     *     return new DifferentPsr3LoggerClass();
     * }
     *
     * Now, calling either logger() or App\Config\Services::logger() will return
     * the modified logger instance.
     * ----------------------------------------------------------------------------
     *
     * @package App\HTTPConfig
     */
    class Services extends ServiceContainer
    {
        // ...
    }
}
