<?php

namespace App\Config {

    // IMPORTS ----------------------------------------------------------------
    use Core\Services\Router\Router as BaseRouter;

    /**
     * ----------------------------------------------------------------------------
     * Router class
     * ----------------------------------------------------------------------------
     *
     * @package App\HTTPConfig
     */
    class Router
    {
        /**
         * The default controller namespace
         *
         * @var string $defaultNamespace
         */
        public static string $defaultNamespace = 'App\Controllers';

        /**
         * Route the application
         *
         * @return void
         */
        public function generate(): void
        {

            // Default 404 handler ...
            $this->router->set404(static function () {
                \Core\System\ErrorController::notFound();
            });

            // Without params
            $this->router->get('/', 'DemoController@index');

            // With params
            $this->router->get('/(\\w+)', 'DemoController@oneArgument');
            $this->router->get('/(\\w+)/(\\w+)', 'DemoController@twoArguments');
        }

        // --------------------------------------------------------------------
        // SYSTEM ROUTER CONFIG - DO NOT MODIFY

        /**
         * Router instance
         *
         * @var BaseRouter $router
         */
        public BaseRouter $router;

        /**
         * Let's build this router and route the application
         */
        public function __construct()
        {
            // Route the application ...
            $this->router = new BaseRouter();

            // Set the default namespace ...
            $this->router->setNamespace(static::$defaultNamespace);

            // Generate the routes ...
            $this->generate();

            // Let's get things going!
            $this->router->run();
        }
    }
}
