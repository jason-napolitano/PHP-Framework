<?php

namespace Core\Services\Parser {

    use Stringable;

    /**
     * ----------------------------------------------------------------------------
     * XML parser
     * ----------------------------------------------------------------------------
     *
     * @package Core\Services\Parser
     */
    class XML implements Stringable, ParserInterface
    {
        protected array $data;

        // --------------------------------------------------------------------

        /**
         * @param array $data
         *
         * @return self
         */
        public function parse(array $data): self
        {
            $this->data = $data;
            return $this;
        }

        // --------------------------------------------------------------------

        /**
         * @return string
         *
         * @throws \JsonException
         */
        public function __toString(): string
        {
            return json_encode($this->data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
        }
    }
}
