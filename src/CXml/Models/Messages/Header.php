<?php

namespace CXml\Models\Messages;

use CXml\Models\Requests\RequestInterface;
use CXml\Models\Responses\ResponseInterface;

class Header implements RequestInterface, MessageInterface
{
    private $senderIdentity;
    private $senderSharedSecret;

    private $fromIdentity;
    private $fromDomain;

    /**
     * @return mixed
     */
    public function getFromIdentity()
    {
        return $this->fromIdentity;
    }

    /**
     * @param mixed $fromIdentity
     *
     * @return Header
     */
    public function setFromIdentity($fromIdentity): self
    {
        $this->fromIdentity = $fromIdentity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFromDomain()
    {
        return $this->fromDomain;
    }

    /**
     * @param mixed $fromDomain
     *
     * @return Header
     */
    public function setFromDomain($fromDomain): self
    {
        $this->fromDomain = $fromDomain;
        return $this;
    }

    public function getSenderIdentity()
    {
        return $this->senderIdentity;
    }

    public function setSenderIdentity($senderIdentity): self
    {
        $this->senderIdentity = $senderIdentity;
        return $this;
    }

    public function getSenderSharedSecret()
    {
        return $this->senderSharedSecret;
    }

    public function setSenderSharedSecret($senderSharedSecret): self
    {
        $this->senderSharedSecret = $senderSharedSecret;
        return $this;
    }

    public function parse(\SimpleXMLElement $headerXml) : void
    {
        $this->senderIdentity = (string)$headerXml->xpath('Sender/Credential/Identity')[0];
        $this->senderSharedSecret = (string)$headerXml->xpath('Sender/Credential/SharedSecret')[0];

        if ($fromCredential = $headerXml->xpath('From/Credential')) {
            $this->fromIdentity = (string)$fromCredential[0]->xpath('Identity')[0];
            $this->fromDomain = (string)$fromCredential[0]->attributes()->domain;
        }
    }

    public function render(\SimpleXMLElement $parentNode) : void
    {
        $headerNode = $parentNode->addChild('Header');

        $this->addNode($headerNode, 'From', 'Unknown');
        $this->addNode($headerNode, 'To', 'Unknown');
        $this->addNode($headerNode, 'Sender', $this->getSenderIdentity() ?? 'Unknown')
            ->addChild('UserAgent', 'Unknown');
    }

    private function addNode(\SimpleXMLElement $parentNode, string $nodeName, string $identity) : \SimpleXMLElement
    {
        $node = $parentNode->addChild($nodeName);

        $credentialNode = $node->addChild('Credential');
        $credentialNode->addAttribute('domain', '');

        $credentialNode->addChild('Identity', $identity);

        return $node;
    }
}
