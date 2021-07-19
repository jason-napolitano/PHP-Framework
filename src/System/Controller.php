<?php

namespace Core\System {

    use Core\Services\HTTP\ResponseTrait;

    /**
     * ----------------------------------------------------------------------------
     * Controller class
     * ----------------------------------------------------------------------------
     *
     * @package  Core
     *
     * @requires PHP 8.0
     */
    class Controller
    {
        // Response trait
        use ResponseTrait;

        /**
         * @param string $model
         */
        public function __construct(protected string $model)
        {
            $this->model = new $model();
        }
    }
}
