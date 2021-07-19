<?php

/**
 * ----------------------------------------------------------------------------
 * The Autoload Library is a PSR-4 compatible utility class that assists in
 * loading of package classmaps and namespaces. Run Autoload::register() to
 * instantiate
 * ----------------------------------------------------------------------------
 *
 * @author  Jason Napolitano
 * @version 1.0.0
 * @license MIT https://mit-license.org/
 */
abstract class Autoload
{
    /**
     * PSR4 namespace array. All namespaces are in key => value pairs where
     * the key is the namespace and the value is the directory to the files
     * in that namespace
     *
     * EXAMPLE:
     * public static array $psr4 = [
     *     'NamespaceName" => __DIR__ . '/path/to/directory'
     * ]
     *
     * @var array $psr4
     */
    protected static array $psr4 = [
        // System entries
        CORE_NAMESPACE => COREPATH,
        APP_NAMESPACE  => APPPATH,

        // Custom entries
        'Exceptions'   => COREPATH . '/Exceptions',
        'Attributes'   => COREPATH . '/Attributes',
    ];

    /**
     * All classmaps are in key => value pairs where the key is the
     * class name and the value is the path to the file containing
     * that class
     *
     * EXAMPLE:
     * public static array $classmap = [
     *     // With .php extension
     *     'ClassName" => __DIR__ . '/path/to/ClassName.php'
     *
     *     // Without .php extension
     *     'ClassName" => __DIR__ . '/path/to/ClassName'
     * ]
     *
     * @var array $classmap
     */
    protected static array $classmap = [
        // ...
    ];

    /**
     * Map of class name prefixes
     *
     * @var array
     */
    protected static array $prefixes = [
        // ...
    ];

    // --------------------------------------------------------------------

    /**
     * Register the autoloader functionality
     *
     * @return void
     */
    public static function register(): void
    {
        // Run the SPL autoloader
        spl_autoload_register([self::class, 'loadClass']);

        // Iterate through the PSR4 namespace array
        $namespacesArray = array_filter(self::$psr4);
        $autoloaderArray = array_filter(\App\Config\Autoload::$psr4);

        if ( ! empty($namespacesArray) ) {
            $namespacesArray = array_merge($namespacesArray, $autoloaderArray);
            foreach ( $namespacesArray as $psr4 => $path ) {
                self::addNamespace($psr4, $path);
            }
        }
        // Iterate through the PSR4 classmap array
        $classmap = array_filter(self::$classmap);
        if ( ! empty($classmap) ) {
            foreach ( self::$classmap as $class => $file ) {
                if ( class_exists($class) ) {
                    self::requireFiles(strpos($file, '.php') ? $file : $file . '.php');
                }
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Adds a namespace to the autoloader
     *
     * @param string $prefix
     * @param string $base_dir
     * @param bool   $prepend
     *
     * @return void
     */
    public static function addNamespace(string $prefix, string $base_dir, bool $prepend = false): void
    {
        // normalize namespace prefix
        $prefix = trim($prefix, '\\') . '\\';
        // normalize the base directory with a trailing separator
        $base_dir = rtrim($base_dir, _DS_) . '/';
        // initialize the namespace prefix array
        if ( isset(self::$prefixes[$prefix]) === false ) {
            self::$prefixes[$prefix] = [];
        }
        // retain the base directory for the namespace prefix
        if ( $prepend ) {
            array_unshift(self::$prefixes[$prefix], $base_dir);
        } else {
            self::$prefixes[$prefix][] = $base_dir;
        }
    }

    // --------------------------------------------------------------------

    /**
     * Require a file or an array of files
     *
     * @param string $files
     *
     * @return bool
     */
    public static function requireFiles(string $files): bool
    {
        if ( file_exists($files) ) {
            require $files;
            return true;
        }
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Loads a class from the autoloader
     *
     * @param string $class
     *
     * @return bool|string
     */
    public static function loadClass(string $class): bool|string
    {
        // the current namespace prefix
        $prefix = $class;
        while ( false !== $pos = strrpos($prefix, '\\') ) {
            // retain the trailing namespace separator in the prefix
            $prefix = substr($class, 0, $pos + 1);
            // the rest is the relative class name
            $relative_class = substr($class, $pos + 1);
            // try to load a mapped file for the prefix and relative class
            $mapped_file = self::loadMappedFile($prefix, $relative_class);
            if ( $mapped_file ) {
                return $mapped_file;
            }
            $prefix = rtrim($prefix, '\\');
        }
        return false;
    }

    // --------------------------------------------------------------------

    /**
     * Loads a mapped file from the autoloader
     *
     * @param string $prefix
     * @param string $relative_class
     *
     * @return bool|string
     */
    protected static function loadMappedFile(string $prefix, string $relative_class): bool|string
    {
        // are there any base directories for this namespace prefix?
        if ( isset(self::$prefixes[$prefix]) === false ) {
            return false;
        }
        foreach ( self::$prefixes[$prefix] as $base_dir ) {
            $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
            // if the mapped file exists, require it
            if ( self::requireFiles($file) ) {
                // yes, we're done
                return $file;
            }
        }
        return false;
    }
}
