<?php

namespace CXml\Models\Messages;

use CXml\Models\Requests\RequestInterface;

class Credential implements RequestInterface, MessageInterface
{
    /**
     * @var string
     */
    protected $domain;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $identity;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var
     */
    protected $sharedSecret;

    /**
     * @var string
     */
    protected $credentialMac;

    /**
     * @var string
     */
    protected $credentialMacType;

    /**
     * @var string
     */
    protected $credentialMacAlgorithm;

    /**
     * @var string
     */
    protected $credentialMacCreationDate;

    /**
     * @var string
     */
    protected $credentialMacExpirationDate;

    public function parse(\SimpleXMLElement $requestNode): void
    {
        $attributes = $requestNode->attributes();
        if (!empty($attributes['domain'])) {
            $this->domain = $attributes['domain'];
        }
        if (!empty($attributes['type'])) {
            $this->domain = $attributes['type'];
        }
        if ($data = current($requestNode->xpath('Identity'))) {
            $this->identity = (string) $data;
        }
        if ($data = current($requestNode->xpath('SharedSecret'))) {
            $this->sharedSecret = (string) $data;
        }
        if ($credentialMac = current($requestNode->xpath('CredentialMac'))) {
            $this->credentialMac = (string) $credentialMac;
            $credentialMacAttributes = $credentialMac->attributes();
            if (!empty($credentialMacAttributes['type'])) {
                $this->credentialMacType = $credentialMacAttributes['type'];
            }
            if (!empty($credentialMacAttributes['algorithm'])) {
                $this->credentialMacAlgorithm = $credentialMacAttributes['algorithm'];
            }
            if (!empty($credentialMacAttributes['creationDate'])) {
                $this->credentialMacCreationDate = $credentialMacAttributes['creationDate'];
            }
            if (!empty($credentialMacAttributes['expirationDate'])) {
                $this->credentialMacExpirationDate = $credentialMacAttributes['expirationDate'];
            }
        }
    }

    public function render(\SimpleXMLElement $parentNode) : void
    {
        $credential = $parentNode->addChild('Credential');
        $credential->addAttribute('domain', $this->domain);
        if (!empty($this->type)) {
            $credential->addAttribute('type', $this->type);
        }
        $credential->addChild('Identity', $this->identity);

        if (!empty($this->sharedSecret)) {
            $credential->addChild('SharedSecret', $this->sharedSecret);
        }

        if (!empty($this->credentialMac)) {
            $credentialMac = $credential->addChild('CredentialMac', $this->credentialMac);

            if (!empty($this->credentialMacType)) {
                $credentialMac->addAttribute('type', $this->credentialMacType);
            }
            if (!empty($this->credentialMacAlgorithm)) {
                $credentialMac->addAttribute('algorithm', $this->credentialMacAlgorithm);
            }
            if (!empty($this->credentialMacCreationDate)) {
                $credentialMac->addAttribute('creationDate', $this->credentialMacCreationDate);
            }
            if (!empty($this->credentialMacExpirationDate)) {
                $credentialMac->addAttribute('expirationDate', $this->credentialMacExpirationDate);
            }
        }
    }

    /**
     * @return string
     */
    public function getDomain(): string
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     *
     * @return Credential
     */
    public function setDomain(string $domain): Credential
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Credential
     */
    public function setType(string $type): Credential
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @param string $identity
     *
     * @return Credential
     */
    public function setIdentity(string $identity): Credential
    {
        $this->identity = $identity;
        return $this;
    }

    /**
     * @return string
     */
    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    /**
     * @param string $userAgent
     *
     * @return Credential
     */
    public function setUserAgent(string $userAgent): Credential
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSharedSecret()
    {
        return $this->sharedSecret;
    }

    /**
     * @param mixed $sharedSecret
     *
     * @return Credential
     */
    public function setSharedSecret($sharedSecret)
    {
        $this->sharedSecret = $sharedSecret;
        return $this;
    }

    /**
     * @return string
     */
    public function getCredentialMac(): string
    {
        return $this->credentialMac;
    }

    /**
     * @param string $credentialMac
     *
     * @return Credential
     */
    public function setCredentialMac(string $credentialMac): Credential
    {
        $this->credentialMac = $credentialMac;
        return $this;
    }

    /**
     * @return string
     */
    public function getCredentialMacType(): string
    {
        return $this->credentialMacType;
    }

    /**
     * @param string $credentialMacType
     *
     * @return Credential
     */
    public function setCredentialMacType(string $credentialMacType): Credential
    {
        $this->credentialMacType = $credentialMacType;
        return $this;
    }

    /**
     * @return string
     */
    public function getCredentialMacAlgorithm(): string
    {
        return $this->credentialMacAlgorithm;
    }

    /**
     * @param string $credentialMacAlgorithm
     *
     * @return Credential
     */
    public function setCredentialMacAlgorithm(string $credentialMacAlgorithm
    ): Credential {
        $this->credentialMacAlgorithm = $credentialMacAlgorithm;
        return $this;
    }

    /**
     * @return string
     */
    public function getCredentialMacCreationDate(): string
    {
        return $this->credentialMacCreationDate;
    }

    /**
     * @param string $credentialMacCreationDate
     *
     * @return Credential
     */
    public function setCredentialMacCreationDate(
        string $credentialMacCreationDate
    ): Credential {
        $this->credentialMacCreationDate = $credentialMacCreationDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getCredentialMacExpirationDate(): string
    {
        return $this->credentialMacExpirationDate;
    }

    /**
     * @param string $credentialMacExpirationDate
     *
     * @return Credential
     */
    public function setCredentialMacExpirationDate(
        string $credentialMacExpirationDate
    ): Credential {
        $this->credentialMacExpirationDate = $credentialMacExpirationDate;
        return $this;
    }


}
