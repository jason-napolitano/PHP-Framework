<?php

namespace Core\Services\FileSystem {

    /**
     * Interface FileHandlerInterface
     *
     * @package Core\Services\FileSystem
     */
    interface FileHandlerInterface
    {
        /**
         * Opens a file stream
         *
         * @return bool
         */
        public function open(): bool;

        // --------------------------------------------------------------------

        /**
         * Add a new file to the end of the $files array
         *
         * @param string $file
         *
         * @return void
         */
        public function addToFilesArray(string $file): void;

        // --------------------------------------------------------------------

        /**
         * Closes an open file stream
         */
        public function close(): void;

        // --------------------------------------------------------------------

        /**
         * Read from a file
         */
        public function read(): void;

        // --------------------------------------------------------------------

        /**
         * Write to a file
         *
         * @return void
         */
        public function write(): void;

        // --------------------------------------------------------------------

        /**
         * Deletes a file
         *
         * @param string $path
         *
         * @return void
         */
        public function delete(string $path): void;
    }
}
