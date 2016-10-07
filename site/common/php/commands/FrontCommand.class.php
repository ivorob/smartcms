<?php

abstract class FrontCommand {
    private $request;

    public function __construct($request) {
        $this->request = $request;
    }

    abstract public function execute(&$response);

    protected function getRequest() {
        return $this->request;
    }

    public function handleCommand($context, &$response) {
        $body = $this->execute($response);
        $response->addBody($body);
        return $response->makeContent();
    }
};

