<?php

class ServerContext {
    private $ServerSettings;
    private $configXML;

    public function __construct() {
        global $_CONFIG;

        $this->ServerSettings = new ServerSettings;
        $this->configXML = $this->arrayToXml(array_flip($_CONFIG));
    }

    public function options() {
        return $this->configXML;
    }

    public function settings() {
        return $this->ServerSettings;
    }

    private function arrayToXML($array) {
        $xml = new SimpleXMLElement('<options />');
        array_walk_recursive($array, array($xml, 'addChild'));

        $domXml = new DOMDocument();
        $domXml->loadXML($xml->asXML());
        return $domXml->saveHTML();
    }
};
