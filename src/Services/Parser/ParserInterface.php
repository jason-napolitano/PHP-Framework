<?php

namespace Core\Services\Parser {

    /**
     * ParserInterface
     *
     * @package Core\Services\Parser
     */
    interface ParserInterface
    {
        /**
         * @param array $data
         *
         * @return self
         */
        public function parse(array $data): self;
    }
}
