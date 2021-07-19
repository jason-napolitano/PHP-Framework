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
     * final
     *
     * Example override of the logger service:
     *
     * public function logger(string: $message, string: $type, string: $channel): LoggerInterface
     * {
     *     return new DifferentPsr3LoggerClass();
     * }
     *
     * Now, calling either logger() or App\Config\Services::logger() will return
     * the modified logger instance
     * ----------------------------------------------------------------------------
     *
     * @package App\HTTPConfig
     */
    class Services extends ServiceContainer
    {
        // ...
    }
}
