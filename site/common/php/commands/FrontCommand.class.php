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

    public function handleCommand($context, $response) {
        $content = $this->execute();
        $response->addXmlContent($content);
        return $response->makeContent();
    }
};

