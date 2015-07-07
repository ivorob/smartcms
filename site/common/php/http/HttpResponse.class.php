<?php

class HttpResponse {
    private $content;

    public function addTransformation($xslt, $xmlData) {
        $xsltTransformer = new XsltTransofrmer($xslt, $xmlData);
        $this->addXmlContent($xsltTransformer->process());
    }

    public function addXmlContent($xmlData) {
        $this->content .= $xmlData;
    }

    public function makeContent() {
        $this->content = '<?xml version="1.0" ?><root>' . $this->content . '</root>';
        $xsltTransformer = new XsltTransformer('../common/templates/default/index.xslt', $this->content);
        return $xsltTransformer->process();
    }
};
