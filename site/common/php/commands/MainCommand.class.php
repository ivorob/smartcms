<?php

class MainCommand extends FrontCommand {
    public function execute(&$response) {
        $response->setTitle('Test page');
        return '<h1>Some text on site</h1>';
    }
};
