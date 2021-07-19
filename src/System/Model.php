<?php

namespace Core\System {

    use Core\Services\QueryBuilder;

    /**
     * ----------------------------------------------------------------------------
     * Class Model
     * ----------------------------------------------------------------------------
     *
     * @package  Core
     *
     * @uses     QueryBuilder
     *
     * @requires PHP 8.0
     */
    class Model
    {
        // QueryBuilder Trait
        use QueryBuilder;

        /** Constructor */
        public function __construct()
        {
            // ...
        }
    }
}
