<?php

class HttpResponse {
    private $content;
    private $title;

    public function addTransformation($xslt, $xmlData) {
        $xsltTransformer = new XsltTransofrmer($xslt, $xmlData);
        $this->addXmlContent($xsltTransformer->process());
    }

    public function addXmlContent($xmlData) {
        $this->content .= $xmlData;
    }

    public function makeContent() {
        $xml = new SimpleXMLElement('<content />');
        $xml->addChild('title', $this->title);
        $xml->addChild('body', 'Some text'); 

        $dom = dom_import_simplexml($xml);
        $this->addXmlContent($dom->ownerDocument->saveXML($dom->ownerDocument->documentElement));

        $this->content = '<?xml version="1.0" ?><root>' . $this->content . '</root>';
        $xsltTransformer = new XsltTransformer('../common/templates/default/index.xslt', $this->content);
        return $xsltTransformer->process();
    }

    public function setTitle($title) {
        $this->title = $title;
    }
};
