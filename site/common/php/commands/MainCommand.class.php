<?php

class MainCommand extends FrontCommand {
    public function execute(&$response) {
        $response->setTitle('Test page');
        return 'Some text on site';
    }
};
