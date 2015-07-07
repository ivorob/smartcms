<?php

class XsltTransformer {
    private $xsltname;
    private $content;

    public function __construct($xslt, $content) {
        $this->xsltname = $xslt;
        $this->content = $content;
    }

    public function process() {
        $xslDoc = new DOMDocument();
        $xslDoc->load($this->xsltname);

        $xmlDoc = new DOMDocument();
        $xmlDoc->loadXML($this->content);

        $proc = new XSLTProcessor();
        $proc->importStylesheet($xslDoc);
        return $proc->transformToXML($xmlDoc);
    }
};
