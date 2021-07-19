<?php

/* ----------------------------------------------------------------------------
 * SHORTHAND SERVICE FUNCTIONS / COMMON FUNCTIONS
 * ----------------------------------------------------------------------------
 * This file is used as a central location for all of the core system services.
 *
 * Any service that lives within \Core\Services, can be called using any of the
 * functions within this file. They act as an abstraction between the developer
 * and the Service container located at \Core\Services\Container.
 * ----------------------------------------------------------------------------
 *
 * @author  Jason Napolitano
 * @version 1.0.0
 * @license MIT https://mit-license.org/
 * ----------------------------------------------------------------------------
 */

// IMPORTS --------------------------------------------------------------------
use App\Config\Services;
use Core\System\Utilities;
use Core\Services\API\JWTInterface;
use Core\Services\Debug\DumpInterface;
use Core\Services\Parser\ParserInterface;
use Core\Services\Session\SessionInterface;
use Core\Services\Libraries\ShoppingCartInterface;
use Core\Services\FileSystem\FileHandlerInterface;

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('service') ) {
    /**
     * Loads a service method from within the service container. For example, if
     * you'd like to call the session service, you could do the following:
     *
     * $session = service('session')
     * $session->set('my-amazing-key', 'my-amazing-value')
     * dump( $session->get('my-amazing-key') ) // Returns `my-amazing-value`
     *
     * @param string $name Name of the service method
     *
     * @return mixed
     */
    function service(string $name): mixed
    {
        return Services::call($name);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('logger') ) {
    /**
     * Calls the logger service, making application logging extremely simple to
     * utilize
     *
     * Example Usage:
     * logger('Application event has been logged!', 'info')
     *
     * @see Services::logger()
     *
     * @param string  $message
     * @param ?string $type Options: [info|warning|debug|notice|error]
     * @param ?string $channel
     *
     * @return void
     */
    function logger(string $message, string $type = null, string $channel = null): void
    {
        Services::logger($message, $type ?? 'info', $channel ?? 'system');
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('cart') ) {
    /**
     * Shopping cart library function
     *
     * @see Services::cart()
     *
     * @return ShoppingCartInterface
     */
    function cart(): ShoppingCartInterface
    {
        return Services::cart();
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('jwt') ) {
    /**
     * JWT library function
     *
     * @see Services::jwt()
     *
     * @return JWTInterface
     */
    function jwt(): JWTInterface
    {
        return Services::jwt();
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('session') ) {
    /**
     * Calls the session service, allowing for easy session data manipulation
     * throughout the application
     *
     * Example:
     * session()->set('my-amazing-key', 'my-amazing-value')
     * dump( session()->get('my-amazing-key') ) // Returns `my-amazing-value`
     *
     * @see Services::session()
     *
     * @param bool $autostart
     *
     * @return SessionInterface
     */
    function session(bool $autostart = true): SessionInterface
    {
        return Services::session($autostart);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('dump') ) {
    /**
     * Calls the dump service for a prettier way to var_dump() and/or print_r()
     *
     * @see Services::dump()
     *
     * @param mixed ...$args
     *
     * @return DumpInterface
     */
    function dump(...$args): DumpInterface
    {
        return Services::dump(...$args);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('dd') ) {
    /**
     * Calls the dump service for a prettier way to var_dump() and/or print_r()
     *
     * @see Services::dd()
     *
     * @param mixed ...$args
     *
     * @return DumpInterface
     */
    function dd(...$args): DumpInterface
    {
        return Services::dd(...$args);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('kill') ) {
    /**
     * A way to stop script execution absolutely
     *
     * @see Services::kill()
     *
     * @return void
     */
    function kill(): void
    {
        Services::kill();
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('clear_log') ) {
    /**
     * Force clear the log file
     *
     * @return bool
     */
    function clear_log(): bool
    {
        if ( file_put_contents(LOGFILE, '') ) {
            return true;
        }
        return false;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( (! function_exists('len')) ) {
    /**
     * Returns the total items in an array or a string
     *
     * @param string|array $content
     *
     * @return int|null
     */
    function len(string|array $content): ?int
    {
        // If an array is passed, use the count() function
        if ( is_array($content) ) {
            return count($content);
        }

        // If a string is passed, use the strlen() function
        if ( is_string($content) ) {
            return strlen($content);
        }

        // If all else fails, return null
        return null;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('implements_interface') ) {
    /**
     * Does a class implement an interface? Use this to avoid instantiating
     * the ReflectionClass multiple times within the codebase
     *
     * @param string $class
     * @param string $interface
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    function implements_interface(string $class, string $interface): bool
    {
        return (new ReflectionClass($class))->implementsInterface($interface);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('is_throwable') ) {
    /**
     * Check to see if a class implements the \Throwable interface
     *
     * @param string $exception
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    function is_throwable(string $exception): bool
    {
        return implements_interface($exception, Throwable::class);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('extends_exception') ) {
    /**
     * Check to see if a class extends \Exception
     *
     * @param string $exception
     *
     * @return bool
     */
    function extends_exception(string $exception): bool
    {
        return is_subclass_of($exception, Exception::class);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('throw_new') ) {
    /**
     * Throw a new Exception. The value of $exception should either implement
     * \Throwable or extend the default \Exception class
     *
     * @param string $message
     * @param string $exception
     *
     * @throws Exception
     */
    function throw_new(string $message, string $exception = \Exceptions\RuntimeException::class): void
    {
        if ( is_throwable($exception) || extends_exception($exception) ) {
            throw new $exception($message);
        }

        throw new Exception($message);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('utils') ) {
    /**
     * A wrapper for the Utilities class components
     */
    function utils(): Utilities
    {
        return new Utilities();
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('parser') ) {
    /**
     * A parser instance to parse JSON and XML data
     *
     * @see Services::parser()
     *
     * @param mixed  $data
     * @param string $format
     *
     * @return ParserInterface
     */
    function parser(mixed $data, string $format = 'json'): ParserInterface
    {
        return Services::parser($data, $format);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('fs') ) {
    /**
     * function_name
     *
     * @param string $path
     *
     * @return FileHandlerInterface
     */
    function fs(string $path): FileHandlerInterface
    {
        return Services::fs($path);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('array_trim') ) {
    /**
     * Trim individual array keys
     *
     * @param array $array
     *
     * @return array
     */
    function array_trim(array $array): array
    {
        return array_map('trim', $array);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('trim_array') ) {
    /**
     * Alias for array_trim()
     *
     * @param array $array
     *
     * @return array
     */
    function trim_array(array $array): array
    {
        return array_trim($array);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('env') ) {
    /**
     * A shorthand function for getenv()
     *
     * @param string $value
     *
     * @return string|array|bool
     */
    function env(string $value): string|array|bool
    {
        return getenv($value);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('checkenv') ) {
    /**
     * Does $environment exist in the env file or as a defined constant?
     *
     * @param string $environment
     *
     * @return bool
     */
    function checkenv(string $environment): bool
    {
        return
            constant('ENVIRONMENT') === $environment ||
            getenv('ENVIRONMENT') === $environment ||
            defined('ENVIRONMENT');
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('strip_namespace') ) {
    /**
     * Strip the namespace from a FQCN
     *
     * @param string $classname
     *
     * @return string
     *
     * @throws ReflectionException
     */
    function strip_namespace(string $classname): string
    {
        return (new ReflectionClass($classname))->getShortName();
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('get_namespace') ) {
    /**
     * Returns only a classes namespace name
     *
     * @param string $classname
     *
     * @return string
     *
     * @throws ReflectionException
     */
    function get_namespace(string $classname): string
    {
        $namespace = (new ReflectionClass($classname))->getNamespaceName();
        return rtrim($namespace, strip_namespace($classname));
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('namespace_exists') ) {
    /**
     * Does a namespace exist?
     *
     * @param string $classname
     * @param string $namespace
     *
     * @return bool
     *
     * @throws ReflectionException
     */
    function namespace_exists(string $namespace, string $classname): bool
    {
        return get_namespace($classname) === $namespace;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('strip_slashes') ) {
    /**
     * Strip Slashes
     *
     * Removes slashes contained in a string or in an array
     *
     * @param mixed    string or array
     *
     * @return    mixed    string or array
     */
    function strip_slashes($str): string
    {
        if ( ! is_array($str) ) {
            return stripslashes($str);
        }

        foreach ( $str as $key => $val ) {
            $str[$key] = strip_slashes($val);
        }

        return $str;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('strip_quotes') ) {
    /**
     * Strip Quotes
     *
     * Removes single and double quotes from a string
     *
     * @param string
     *
     * @return    string
     */
    function strip_quotes($str): string
    {
        return str_replace(['"', "'"], '', $str);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('quotes_to_entities') ) {
    /**
     * Quotes to Entities
     *
     * Converts single and double quotes to entities
     *
     * @param string
     *
     * @return    string
     */
    function quotes_to_entities($str): string
    {
        return str_replace(["\'", "\"", "'", '"'], ["&#39;", "&quot;", "&#39;", "&quot;"], $str);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('reduce_double_slashes') ) {
    /**
     * Reduce Double Slashes
     *
     * Converts double slashes in a string to a single slash,
     * except those found in http://
     *
     * http://www.some-site.com//index.php
     *
     * becomes:
     *
     * http://www.some-site.com/index.php
     *
     * @param string
     *
     * @return    string
     */
    function reduce_double_slashes($str): string
    {
        return preg_replace('#(^|[^:])//+#', '\\1/', $str);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('reduce_multiples') ) {
    /**
     * Reduce Multiples
     *
     * Reduces multiple instances of a particular character.  Example:
     *
     * Fred,, Bill,, Joe, Jimmy
     *
     * becomes:
     *
     * Fred, Bill, Joe, Jimmy
     *
     * @param string The string to perform the reduce on
     * @param string The character you wish to reduce
     * @param bool   Whether to trim the character from the beginning/end
     *
     * @return    string
     */
    function reduce_multiples($str, $character = ',', $trim = false): string
    {
        $str = preg_replace('#' . preg_quote($character, '#') . '{2,}#', $character, $str);
        return ($trim === true) ? trim($str, $character) : $str;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('random_string') ) {
    /**
     * Create a "Random" String
     *
     * @param string $type
     * @param int    $len
     *
     * @return string
     */
    function random_string(string $type = 'alpha', int $len = 16): string
    {
        switch ( $type ) {
            case 'basic':
                return mt_rand();
            case 'alnum':
            case 'numeric':
            case 'nozero':
            case 'alpha':
                $pool = match ($type) {
                    'alpha' => 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'alnum' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
                    'numeric' => '0123456789',
                    'nozero' => '123456789',
                };
                return substr(str_shuffle(str_repeat($pool, ceil($len / strlen($pool)))), 0, $len);
            case 'md5':
                return md5(uniqid(mt_rand(), true));
            case 'sha1':
                return sha1(uniqid(mt_rand(), true));
        }
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('increment_string') ) {
    /**
     * Add's _1 to a string or increment the ending number to allow _2, _3, etc
     *
     * @param string    required
     * @param string    What should the duplicate number be appended with
     * @param string    Which number should be used for the first dupe increment
     *
     * @return string
     */
    function increment_string($str, $separator = '_', $first = 1): string
    {
        preg_match('/(.+)' . preg_quote($separator, '/') . '([0-9]+)$/', $str, $match);
        return isset($match[2]) ? $match[1] . $separator . ($match[2] + 1) : $str . $separator . $first;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('alternator') ) {
    /**
     * Allows strings to be alternated
     *
     * @return string
     */
    function alternator(): string
    {
        static $i;

        if ( func_num_args() === 0 ) {
            $i = 0;
            return '';
        }

        $args = func_get_args();
        return $args[($i++ % count($args))];
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('directory_map') ) {
    /**
     * Reads the specified directory and builds an array representation of it. Sub-folders
     * contained with the directory will be mapped as well.
     *
     * @param string $source_dir
     * @param int    $directory_depth
     * @param bool   $hidden
     *
     * @return array|bool
     */
    function directory_map(string $source_dir, int $directory_depth = 0, bool $hidden = false): array|bool
    {
        if ( $fp = @opendir($source_dir) ) {
            $filedata = [];
            $new_depth = $directory_depth - 1;
            $source_dir = rtrim($source_dir, DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;

            while ( false !== ($file = readdir($fp)) ) {
                // Remove '.', '..', and hidden files [optional]
                if ( $file === '.' or $file === '..' or ($hidden === false && $file[0] === '.') ) {
                    continue;
                }

                is_dir($source_dir . $file) && $file .= DIRECTORY_SEPARATOR;

                if ( ($directory_depth < 1 or $new_depth > 0) && is_dir($source_dir . $file) ) {
                    $filedata[$file] = directory_map($source_dir . $file, $new_depth, $hidden);
                } else {
                    $filedata[] = $file;
                }
            }

            closedir($fp);
            return $filedata;
        }

        return false;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('write_file') ) {
    /**
     * Writes data to the file specified in the path. Creates a new file if
     * non-existent.
     *
     * @param string $path
     * @param string $data
     * @param string $mode
     *
     * @return bool
     */
    function write_file(string $path, string $data, string $mode = 'wb'): bool
    {
        if ( ! $fp = @fopen($path, $mode) ) {
            return false;
        }

        flock($fp, LOCK_EX);

        for ( $result = $written = 0, $length = strlen($data); $written < $length; $written += $result ) {
            if ( ($result = fwrite($fp, substr($data, $written))) === false ) {
                break;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return is_int($result);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('delete_files') ) {
    /**
     * Deletes all files contained in the supplied directory path.
     * Files must be writable or owned by the system in order to be deleted.
     * If the second parameter is set to TRUE, any directories contained
     * within the supplied base directory will be nuked as well.
     *
     * @param string $path    File path
     * @param bool   $del_dir Whether to delete any directories found in the path
     * @param bool   $htdocs  Whether to skip deleting .htaccess and index page files
     * @param int    $_level  Current directory depth level (default: 0; internal use only)
     *
     * @return bool
     */
    function delete_files(string $path, bool $del_dir = false, bool $htdocs = false, int $_level = 0): bool
    {
        // Trim the trailing slash
        $path = rtrim($path, '/\\');

        if ( ! $current_dir = @opendir($path) ) {
            return false;
        }

        while ( false !== ($filename = @readdir($current_dir)) ) {
            if ( $filename !== '.' && $filename !== '..' ) {
                $filepath = $path . DIRECTORY_SEPARATOR . $filename;

                if ( is_dir($filepath) && $filename[0] !== '.' && ! is_link($filepath) ) {
                    delete_files($filepath, $del_dir, $htdocs, $_level + 1);
                } else if ( $htdocs !== true or ! preg_match('/^(\.htaccess|index\.(html|htm|php)|web\.config)$/i', $filename) ) {
                    @unlink($filepath);
                }
            }
        }

        closedir($current_dir);

        return ! ($del_dir === true && $_level > 0) || @rmdir($path);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('get_filenames') ) {
    /**
     * Reads the specified directory and builds an array containing the filenames.
     * Any sub-folders contained within the specified path are read as well.
     *
     * @param string $source_dir
     * @param bool   $include_path
     * @param bool   $_recursion
     *
     * @return array|bool
     */
    function get_filenames(string $source_dir, bool $include_path = false, bool $_recursion = false): array|bool
    {
        static $_filedata = [];

        if ( $fp = @opendir($source_dir) ) {
            // reset the array and make sure $source_dir has a trailing slash on the initial call
            if ( $_recursion === false ) {
                $_filedata = [];
                $source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            }

            while ( false !== ($file = readdir($fp)) ) {
                if ( is_dir($source_dir . $file) && $file[0] !== '.' ) {
                    get_filenames($source_dir . $file . DIRECTORY_SEPARATOR, $include_path, true);
                } else if ( $file[0] !== '.' ) {
                    $_filedata[] = ($include_path === true) ? $source_dir . $file : $file;
                }
            }

            closedir($fp);
            return $_filedata;
        }

        return false;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('get_dir_file_info') ) {
    /**
     * Reads the specified directory and builds an array containing the filenames,
     * filesize, dates, and permissions
     *
     * @param       $source_dir
     * @param bool  $top_level_only
     * @param false $_recursion
     *
     * @return array|bool
     */
    function get_dir_file_info(string $source_dir, bool $top_level_only = true, bool $_recursion = false): array|bool
    {
        static $_filedata = [];
        $relative_path = $source_dir;

        if ( $fp = @opendir($source_dir) ) {
            // reset the array and make sure $source_dir has a trailing slash on the initial call
            if ( $_recursion === false ) {
                $_filedata = [];
                $source_dir = rtrim(realpath($source_dir), DIRECTORY_SEPARATOR) . DIRECTORY_SEPARATOR;
            }

            // Used to be foreach (scandir($source_dir, 1) as $file), but scandir() is simply not as fast
            while ( false !== ($file = readdir($fp)) ) {
                if ( is_dir($source_dir . $file) && $file[0] !== '.' && $top_level_only === false ) {
                    get_dir_file_info($source_dir . $file . DIRECTORY_SEPARATOR, $top_level_only, true);
                } else if ( $file[0] !== '.' ) {
                    $_filedata[$file] = get_file_info($source_dir . $file);
                    $_filedata[$file]['relative_path'] = $relative_path;
                }
            }

            closedir($fp);
            return $_filedata;
        }

        return false;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('get_file_info') ) {
    /**
     * Second parameter allows you to explicitly declare what information you want returned
     * Options are: name, server_path, size, date, readable, writable, executable, fileperms
     * Returns FALSE if the file cannot be found.
     *
     * @param string         $file
     * @param array|string[] $returned_values
     *
     * @return array|bool
     */
    function get_file_info(string $file, array $returned_values = ['name', 'server_path', 'size', 'date']): array|bool
    {
        if ( ! file_exists($file) ) {
            return false;
        }

        if ( is_string($returned_values) ) {
            $returned_values = explode(',', $returned_values);
        }

        foreach ( $returned_values as $key ) {
            switch ( $key ) {
                case 'name':
                    $fileinfo['name'] = basename($file);
                    break;
                case 'server_path':
                    $fileinfo['server_path'] = $file;
                    break;
                case 'size':
                    $fileinfo['size'] = filesize($file);
                    break;
                case 'date':
                    $fileinfo['date'] = filemtime($file);
                    break;
                case 'readable':
                    $fileinfo['readable'] = is_readable($file);
                    break;
                case 'writable':
                    $fileinfo['writable'] = is_writable($file);
                    break;
                case 'executable':
                    $fileinfo['executable'] = is_executable($file);
                    break;
                case 'fileperms':
                    $fileinfo['fileperms'] = fileperms($file);
                    break;
            }
        }

        return $fileinfo;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('symbolic_permissions') ) {
    /**
     * Takes a numeric value representing a file's permissions and returns
     * standard symbolic notation representing that value
     *
     * @param mixed $perms
     *
     * @return string
     */
    function symbolic_permissions(mixed $perms): string
    {
        if ( ($perms & 0xC000) === 0xC000 ) {
            $symbolic = 's'; // Socket
        } else if ( ($perms & 0xA000) === 0xA000 ) {
            $symbolic = 'l'; // Symbolic Link
        } else if ( ($perms & 0x8000) === 0x8000 ) {
            $symbolic = '-'; // Regular
        } else if ( ($perms & 0x6000) === 0x6000 ) {
            $symbolic = 'b'; // Block special
        } else if ( ($perms & 0x4000) === 0x4000 ) {
            $symbolic = 'd'; // Directory
        } else if ( ($perms & 0x2000) === 0x2000 ) {
            $symbolic = 'c'; // Character special
        } else if ( ($perms & 0x1000) === 0x1000 ) {
            $symbolic = 'p'; // FIFO pipe
        } else {
            $symbolic = 'u'; // Unknown
        }

        // Owner
        $symbolic .= (($perms & 0x0100) ? 'r' : '-')
            . (($perms & 0x0080) ? 'w' : '-')
            . (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x') : (($perms & 0x0800) ? 'S' : '-'));

        // Group
        $symbolic .= (($perms & 0x0020) ? 'r' : '-')
            . (($perms & 0x0010) ? 'w' : '-')
            . (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x') : (($perms & 0x0400) ? 'S' : '-'));

        // World
        $symbolic .= (($perms & 0x0004) ? 'r' : '-')
            . (($perms & 0x0002) ? 'w' : '-')
            . (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x') : (($perms & 0x0200) ? 'T' : '-'));

        return $symbolic;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('octal_permissions') ) {
    /**
     * Takes a numeric value representing a file's permissions and returns
     * a three character string representing the file's octal permissions
     *
     * @param mixed $perms
     *
     * @return string
     */
    function octal_permissions(mixed $perms): string
    {
        return substr(sprintf('%o', $perms), -3);
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('byte_format') ) {
    /**
     * Formats a numbers as bytes, based on size, and adds the appropriate
     * suffix
     *
     * @param mixed $num Will be cast as int
     * @param int   $precision
     *
     * @return string
     */
    function byte_format(mixed $num, int $precision = 1): string
    {
        if ( $num >= 1000000000000 ) {
            $num = round($num / 1099511627776, $precision);
            $unit = 'TB';
        } else if ( $num >= 1000000000 ) {
            $num = round($num / 1073741824, $precision);
            $unit = 'GB';
        } else if ( $num >= 1000000 ) {
            $num = round($num / 1048576, $precision);
            $unit = 'MB';
        } else if ( $num >= 1000 ) {
            $num = round($num / 1024, $precision);
            $unit = 'KB';
        } else {
            $unit = 'Bytes';
            return number_format($num) . ' ' . $unit;
        }

        return number_format($num, $precision) . ' ' . $unit;
    }
}

// ----------------------------------------------------------------------------
// If the function doesn't exist, let's create it!
if ( ! function_exists('function_name') ) {
    /**
     * function_name
     */
    function function_name()
    {
        // ...
    }
}
