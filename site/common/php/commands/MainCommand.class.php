<?php

class MainCommand extends FrontCommand {
    public function execute() {
        $xml = new SimpleXMLElement('<content />');
        $xml->addChild('title', 'Test page');
        $xml->addChild('body', 'Some text on site');

        $domXml = new DOMDocument();
        $domXml->loadXML($xml->asXML());
        return $domXml->saveHTML();
    }
};
