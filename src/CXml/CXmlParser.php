<?php

namespace CXml;

use CXml\Models\CXml;
use CXml\Models\Header;
use CXml\Models\Requests\RequestInterface;

class CXmlParser
{

    protected $cXmlClassName;
    protected RequestFactoryInterface $requestFactory;

    public function __construct(RequestFactoryInterface $requestFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->cXmlClassName = CXml::class;
    }

    public function setCxmlClassName(string $cXmlClassName) {
        $this->cXmlClassName = $cXmlClassName;
    }

    public function getCxmlClassName() {
        return $this->cXmlClassName;
    }

    public function parse(string $xmlContent) : CXml
    {
        // Load XML
        $xml = new \SimpleXMLElement($xmlContent);
        /** @var CXml $cXml */
        $cXml = new $this->cXmlClassName();

        // Locale
        $xmlAttributes = $xml->attributes('xml', true);
        if (isset($xmlAttributes['lang'])) {
            $cXml->setLocale($xmlAttributes['lang']);
        }
        if ($payloadID = $xml->attributes()->payloadID) {
            $cXml->setPayloadId((string) $payloadID);
        }
        if ($timestamp = $xml->attributes()->timestamp) {
            $cXml->setTimestamp(new \DateTime((string) $timestamp));
        }

        // Header
        $header = new Header();
        $header->parse($xml->xpath('Header')[0]);
        $cXml->setHeader($header);

        // Requests
        foreach ($xml->xpath('Request/*') as $requestNode) {
            $request = $this->requestFactory->create($requestNode->getName());
            $request->parse($requestNode);
            $cXml->addRequest($request);
        }

        return $cXml;
    }
}
