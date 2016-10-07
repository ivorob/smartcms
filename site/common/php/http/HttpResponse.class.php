<?php

class HttpResponse {
    private $content    = '';
    private $title      = '';
    private $body       = '';

    public function addTransformation($xslt, $xmlData) {
        $xsltTransformer = new XsltTransofrmer($xslt, $xmlData);
        $this->addXmlContent($xsltTransformer->process());
    }

    public function addXmlContent($xmlData) {
        $this->content .= $xmlData;
    }

    public function addBody($xmlData) {
        $this->body .=  $xmlData;
    }

    public function makeContent() {
        $xml_content = "<content>";
        $xml_content .= "<title>" . htmlspecialchars($this->title) . "</title>";
        $xml_content .= "<body>" . $this->body . "</body>";
        $xml_content .= "</content>";
        $this->addXmlContent($xml_content);

        $this->content = '<?xml version="1.0" ?><root>' . $this->content . '</root>';
        $xsltTransformer = new XsltTransformer('../common/templates/default/index.xslt', $this->content);
        return $xsltTransformer->process();
    }

    public function setTitle($title) {
        $this->title = $title;
    }
};
