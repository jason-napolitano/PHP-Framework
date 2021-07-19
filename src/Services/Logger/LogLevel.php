<?php

namespace Core\Services\Logger {
    /**
     * ----------------------------------------------------------------------------
     * LogLevel class
     * ----------------------------------------------------------------------------
     *
     * @package Core\Logger
     */
    class LogLevel
    {
        public const EMERGENCY = 'emergency';
        public const ALERT = 'alert';
        public const CRITICAL = 'critical';
        public const ERROR = 'error';
        public const WARNING = 'warning';
        public const NOTICE = 'notice';
        public const INFO = 'info';
        public const DEBUG = 'debug';
    }
}