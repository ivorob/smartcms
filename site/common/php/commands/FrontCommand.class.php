<?php

abstract class FrontCommand {
    private $request;

    public function __construct($request) {
        $this->request = $request;
    }

    abstract public function execute();

    protected function getRequest() {
        return $this->request;
    }
};

