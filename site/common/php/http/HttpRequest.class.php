<?php

class HttpRequest {
    private $parameters;

    public function __construct($query) {
        $this->parseQuery($query);
    }

    public function getParameter($index) {
        if (count($this->parameters) >= $index) {
            return "";
        }

        return $this->parameters[$index];
    }

    private function parseQuery($query) {
        $parameters = explode('/', $_SERVER['REQUEST_URI']);
        foreach ($parameters as $value) {
            if (!empty($value) &&
                preg_match("/$[a-zA-Z0-9_]*$/", $value))
            {
                $this->parameters[] = $value;
            }
        }
    }
};
