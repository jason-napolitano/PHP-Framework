<?php

namespace App\Controllers {

    // IMPORTS ----------------------------------------------------------------
    use Core\System\Controller;

    /**
     * DemoController class
     *
     * @package App\Controllers
     */
    class DemoController extends Controller
    {
        /**
         * A basic example of routing to a controller method without any arguments
         * being passed into the router
         */
        public function index(): void
        {
            $data = ['message' => env('HOME_MESSAGE')];
            self::response(data: $data, code: HTTP_OK);
        }

        /**
         * An example of routing to a controller method with a single argument being
         * passed into the router
         *
         * @param string|int $arg
         *
         * @throws \ReflectionException
         */
        public function oneArgument(string|int $arg): void
        {
            $data = ['message' => 'Data passed into ' . strip_namespace(__CLASS__) . " was `$arg`"];
            self::response(data: $data, code: HTTP_OK);
        }

        /**
         * An example of routing to a controller method with multiple arguments being
         * passed into the router
         *
         * @param string|int $arg1
         * @param string|int $arg2
         */
        public function twoArguments(string|int $arg1, string|int $arg2 = ''): void
        {
            $data = ['message' => "The first argument passed is `$arg1` and the second argument is `$arg2`"];
            self::response(data: $data, code: HTTP_OK);
        }
    }
}
