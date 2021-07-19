<?php

namespace Core\Services\FileSystem {

    // IMPORTS ----------------------------------------------------------------
    use Countable;
    use Stringable;

    /**
     * ------------------------------------------------------------------------
     * This class is responsible for loading files within the system and
     * validating their existence
     * ------------------------------------------------------------------------
     *
     * @package  Core\FileSystem
     */
    class FileHandler implements FileHandlerInterface, Countable, Stringable
    {
        /**
         * Array of files
         *
         * @var array $files
         */
        protected array $files = [];

        /**
         * The path to the file to work with
         *
         * @var string
         */
        public function __construct(
            protected string $path
        )
        { /* ... */
        }

        // --------------------------------------------------------------------

        /**
         * Opens a file stream
         *
         * @return bool FALSE on error
         */
        public function open(): bool
        {
            if ( $this->exists($this->path) ) {
                $this->addToFilesArray($this->path);
                fopen($this->path, 'r+b');
                return true;
            }
            return false;
        }

        // --------------------------------------------------------------------

        /**
         * Check if a file exists
         *
         * @param string $file The file to check
         *
         * @return bool        TRUE on success, FALSE on failure
         */
        protected function exists(string $file): bool
        {
            return file_exists($file);
        }

        // --------------------------------------------------------------------

        /**
         * Add a new file to the end of the $files array
         *
         * @param string $file
         *
         * @return void
         */
        public function addToFilesArray(string $file): void
        {
            $this->files = [...$this->files, $file];
        }

        // --------------------------------------------------------------------

        /**
         * Closes an open file stream
         */
        public function close(): void
        {
            // TODO: Implement close() method.
        }

        // --------------------------------------------------------------------

        /**
         * Read from a file
         */
        public function read(): void
        {
            // ...
        }

        // --------------------------------------------------------------------

        /**
         * Write to a file
         *
         * @return void
         */
        public function write(): void
        {
            // ...
        }

        // --------------------------------------------------------------------

        /**
         * Deletes a file
         *
         * @param string $path
         *
         * @return void
         */
        public function delete(string $path): void
        {
            if ( ! file_exists($path) ) {
                self::throwError();
            }
            @unlink($path);
        }

        // --------------------------------------------------------------------

        /**
         * Throws a new File
         */
        public static function throwError(): void
        {
            throw new \Exceptions\FileSystem\FileNotFoundException();
        }

        // --------------------------------------------------------------------

        /**
         * Forces a deletion of all files and folders within the specified
         * directory. WARNING: It is not possible to retrieve any and / or
         * all files and directories if using this method.
         *
         * @param string|null $deleteDirectory
         */
        public function forceDelete(string $directory = ''): void
        {
            if ( ! file_exists($directory) ) {
                self::throwError();
            }

            $deleteDirectory = null;
            $deleteDirectory = static function ($path) use (&$deleteDirectory) {
                $resource = opendir($path);
                while ( ($item = readdir($resource)) !== false ) {
                    if ( $item !== "." && $item !== ".." ) {
                        if ( is_dir($path . "/" . $item) ) {
                            $deleteDirectory($path . "/" . $item);
                        } else {
                            unlink($path . "/" . $item);
                        }
                    }
                }
                closedir($resource);
                rmdir($path);
            };

            $deleteDirectory($directory);
        }

        // --------------------------------------------------------------------

        /**
         * Return a count of all files in the $files array
         *
         * @return int
         */
        public function count(): int
        {
            return count($this->files);
        }

        // --------------------------------------------------------------------

        /**
         * Returns the $files array as a string
         *
         * @return string
         */
        public function __toString(): string
        {
            return implode(',', $this->files);
        }

        // --------------------------------------------------------------------

        /**
         * Removes a file from the $files array
         *
         * @param string $file
         *
         * @return void
         */
        protected function removeFromFilesArray(string $file): void
        {
            if ( ($key = array_search($file, $this->files, true)) !== false ) {
                unset($this->files[$key]);
            }
        }
    }
}
