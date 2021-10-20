<?php

namespace CXml\Models\Messages;

use CXml\Models\Requests\RequestInterface;

class Header implements RequestInterface, MessageInterface
{
    private $senderIdentity;
    private $senderSharedSecret;

    private $fromIdentity;
    private $fromDomain;

    /**
     * @var \CXml\Models\Messages\Credential[]
     */
    private $fromCredentials;
    /**
     * @var \CXml\Models\Messages\Credential[]
     */
    private $toCredentials;
    /**
     * @var \CXml\Models\Messages\Credential[]
     */
    private $senderCredentials;

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

    /**
     * @return \CXml\Models\Messages\Credential[]
     */
    public function getFromCredentials(): array
    {
        return $this->fromCredentials;
    }

    /**
     * @param \CXml\Models\Messages\Credential[] $fromCredentials
     *
     * @return Header
     */
    public function setFromCredentials(array $fromCredentials): Header
    {
        $this->fromCredentials = $fromCredentials;
        return $this;
    }

    /**
     * @return \CXml\Models\Messages\Credential[]
     */
    public function getToCredentials(): array
    {
        return $this->toCredentials;
    }

    /**
     * @param \CXml\Models\Messages\Credential[] $toCredentials
     *
     * @return Header
     */
    public function setToCredentials(array $toCredentials): Header
    {
        $this->toCredentials = $toCredentials;
        return $this;
    }

    /**
     * @return \CXml\Models\Messages\Credential[]
     */
    public function getSenderCredentials(): array
    {
        return $this->senderCredentials;
    }

    /**
     * @param \CXml\Models\Messages\Credential[] $senderCredentials
     *
     * @return Header
     */
    public function setSenderCredentials(array $senderCredentials): Header
    {
        $this->senderCredentials = $senderCredentials;
        return $this;
    }

    public function parse(\SimpleXMLElement $headerXml) : void
    {
        $this->senderIdentity = (string)$headerXml->xpath('Sender/Credential/Identity')[0];
        $this->senderSharedSecret = (string)$headerXml->xpath('Sender/Credential/SharedSecret')[0];


        // cXml Spec as of January 2021
        // http://xml.cxml.org/current/cXMLGettingStarted.pdf
        // 3.1.7.5  Credential
        // Multiple Credentials
        // The receiver should reject the document if there are multiple
        // credentials in a To, From, or Sender section that use different
        // values but use the same domain.
        // @TODO Figure out how this is in the specification while the SAP
        // catalog tester (https://service.ariba.com/CatalogTester.aw) happily
        // sends payload that violates this....
        if ($fromCredentials = $headerXml->xpath('From/Credential')) {
            $this->fromIdentity = (string)$fromCredentials[0]->xpath('Identity')[0];
            $this->fromDomain = (string)$fromCredentials[0]->attributes()->domain;

            foreach ($fromCredentials as $fromCredential) {
                $credential = new Credential();
                $credential->parse($fromCredential);
//                if (isset($this->fromCredentials[$credential->getDomain()])) {
//                    throw new \Exception('Duplicated "From" credential. Only one credential per domain is valid. See 3.1.7.5  Credential http://xml.cxml.org/current/cXMLGettingStarted.pdf');
//                }
                $this->fromCredentials[$credential->getDomain()] = $credential;
            }
        }

        if ($toCredentials = $headerXml->xpath('To/Credential')) {
            foreach ($toCredentials as $toCredential) {
                $credential = new Credential();
                $credential->parse($toCredential);
//                if (isset($this->toCredentials[$credential->getDomain()])) {
//                    throw new \Exception('Duplicated "To" credential. Only one credential per domain is valid. See 3.1.7.5  Credential http://xml.cxml.org/current/cXMLGettingStarted.pdf');
//                }
                $this->toCredentials[$credential->getDomain()] = $credential;
            }
        }

        if ($senderCredentials = $headerXml->xpath('Sender/Credential')) {
            foreach ($senderCredentials as $senderCredential) {
                $credential = new Credential();
                $credential->parse($senderCredential);
//                if (isset($this->senderCredentials[$credential->getDomain()])) {
//                    throw new \Exception('Duplicated "Sender" credential. Only one credential per domain is valid. See 3.1.7.5  Credential http://xml.cxml.org/current/cXMLGettingStarted.pdf');
//                }
                $this->senderCredentials[$credential->getDomain()] = $credential;
            }
        }
    }

    public function render(\SimpleXMLElement $parentNode) : void
    {
        $headerNode = $parentNode->addChild('Header');

        if ($this->fromCredentials) {
            $fromNode = $headerNode->addChild('From');
            foreach ($this->fromCredentials as $fromCredential) {
                $fromCredential->render($fromNode);
            }
        }
        else {
            $this->addNode($headerNode, 'From', $this->fromIdentity ?? 'Unknown');
        }

        if ($this->toCredentials) {
            $toNode = $headerNode->addChild('To');
            foreach ($this->toCredentials as $toCredential) {
                $toCredential->render($toNode);
            }
        }
        else {
            $this->addNode($headerNode, 'To', 'Unknown');
        }

        if ($this->senderCredentials) {
            $senderNode = $headerNode->addChild('Sender');
            foreach ($this->senderCredentials as $senderCredential) {
                $senderCredential->render($senderNode);
            }
        }
        else {
            $this->addNode($headerNode, 'Sender', $this->getSenderIdentity() ?? 'Unknown')
                ->addChild('UserAgent', 'Unknown');
        }
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
