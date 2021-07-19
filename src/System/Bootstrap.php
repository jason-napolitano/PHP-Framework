<?php

// Dependencies
use Core\Services\DotEnv\DotEnv;
use Exceptions\RuntimeException;

/**
 * ----------------------------------------------------------------------------
 * The bootstrap class is used to get the entire project started up and getting
 * it running correctly. This class is responsible for routing the application,
 * initializing the autoloader and setting up the DotEnv library
 * ----------------------------------------------------------------------------
 */
class Bootstrap
{
    /**
     * ------------------------------------------------------------------------
     * Run the bootstrap process
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public static function run(): void
    {
        self::appLoader(); // File loader
        self::dotenv();    // env config
        // We only want to use the router if we are not using CLI
        self::route();
    }

    /**
     * ------------------------------------------------------------------------
     * Load helper files
     * ------------------------------------------------------------------------
     *
     * TODO - FIND A MORE ECONOMICAL APPROACH ...
     *
     * @return void
     */
    protected static function appLoader(): void
    {
        // Fundamental scripts
        require_once __DIR__ . '/Constants.php';
        require_once APPPATH . '/System/Constants.php';
        require_once APPPATH . '/System/Common.php';
        require_once __DIR__ . '/Common.php';
        require_once APPPATH . '/Config/Autoload.php';
        require_once COREPATH . '/System/Autoload.php';

        // Composer support
        $autoloader = VENDORPATH . '/autoload.php';
        if ( file_exists($autoloader) ) {
            require_once $autoloader;
        }

        // Register the core autoloader
        Autoload::register();
    }

    /**
     * ------------------------------------------------------------------------
     * Load and configure environment variables
     * ------------------------------------------------------------------------
     *
     * @see DotEnv
     *
     * @return void
     */
    public static function dotenv(): void
    {
        try {
            $envFilename = ENVFILE . '.' . ENVIRONMENT;
            if ( file_exists(ENVPATH . $envFilename) ) {
                // environment based config to be loaded first if it exists
                $dotEnv = new DotEnv(ENVPATH, $envFilename);
            } else {
                // If not, let's load a regular .env file instead
                $dotEnv = new DotEnv(ENVPATH, ENVFILE);
            }

            $dotEnv->load();
        } catch ( Throwable ) {
            self::throw('A CRITICAL error has occurred: Env bootstrap process failed to initialize');
        }
    }

    /**
     * Throw an error within the bootstrap process
     *
     * @param string $message Error message
     */
    public static function throw(string $message): void
    {
        if ( ENVIRONMENT !== 'production' ) {
            logger($message, 'critical');
            throw new RuntimeException($message);
        }
        logger($message, 'critical');
    }

    /**
     * ------------------------------------------------------------------------
     * Router the application
     * ------------------------------------------------------------------------
     *
     * @return void
     */
    public static function route(): void
    {
        // Let's make sure that we're not implementing the router on CLI calls
        if ( ! defined('STDIN') ) {
            // If not, start up the router service!
            new \App\Config\Router();
        }
    }
}
