<?php

namespace App\Config {

    // IMPORTS ----------------------------------------------------------------
    use Core\System\ErrorController;
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
        public function init(): void
        {
            // Without params
            $this->router->get('/', 'DemoController@index');

            // With params
            $this->router->get('/(\\w+)', 'DemoController@oneArgument');
            $this->router->get('/(\\w+)/(\\w+)', 'DemoController@twoArguments');
        }

        // --------------------------------------------------------------------

        /**
         * Router instance
         *
         * @var BaseRouter $router
         */
        public BaseRouter $router;

        // --------------------------------------------------------------------
        // SYSTEM ROUTER CONFIG

        /**
         * Let's supply some routes and kick some ass!
         */
        public function __construct()
        {
            // Route it ...
            $this->router = new BaseRouter();

            // Default namespace
            $this->router->setNamespace(static::$defaultNamespace);

            // Default 404 handler
            $this->router->set404(static function () {
                ErrorController::notFound();
            });

            // initialize it ...
            $this->init();

            // And, run it!
            $this->router->run();
        }
    }
}
