<?php

namespace Core\System {

    use App\Config\HTTP;

    /**
     * NotFoundController class
     *
     * @package Core\System
     */
    class ErrorController extends Controller
    {
        public static function notFound(): void
        {
            $code = HTTP::$codes;

            self::setStatusCode(HTTP_NOT_FOUND);
            self::response([
                'message' => $code[HTTP_NOT_FOUND],
            ]);
        }
    }
}
