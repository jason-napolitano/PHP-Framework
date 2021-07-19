<?php

namespace App\Controllers {

    // IMPORTS ----------------------------------------------------------------
    use Core\System\Controller;

    /**
     * DemoController class
     *
     * @package App\Controllers
     */
    abstract class DemoController extends Controller
    {

        public static function index(): void
        {
            $data = ['message' => get_namespace(__CLASS__)];
            self::response(data: $data, code: HTTP_OK);
        }

        public static function home($arg): void
        {
            $data = ['message' => 'Data passed into ' . strip_namespace(__CLASS__) . " was `$arg`"];
            self::response(data: $data, code: HTTP_OK);
        }
    }
}
