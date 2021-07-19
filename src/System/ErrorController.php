<?php

namespace Core\System {

    /**
     * NotFoundController class
     *
     * @package Core\System
     */
    class ErrorController extends Controller
    {
        public static function notFound(): void
        {
            self::setStatusCode(HTTP_NOT_FOUND);
            respond([
                'message' => 'Route not found',
            ]);
        }
    }
}
