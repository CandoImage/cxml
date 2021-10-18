<?php

namespace CXml\Models\Requests;

use CXml\Models\Messages\Contact;
use CXml\Models\EntrinsicTrait;

class PunchOutSetupRequest implements RequestInterface
{
    use EntrinsicTrait;

    /**
     * @var string|null 
     */
    private $operation;

    /**
     * @var string|null 
     */
    private $buyerCookie;

    /**
     * @var string|null 
     */
    private $browserFormPostUrl;

    /**
     * @var \CXml\Models\Messages\Contact[] 
     */
    private $contact = [];

    /**
     * @noinspection PhpUndefinedFieldInspection 
     */
    public function parse(\SimpleXMLElement $requestNode): void
    {
        $this->operation = (string)$requestNode->attributes()->operation;
        $this->buyerCookie = $requestNode->xpath('BuyerCookie')[0];
        $this->browserFormPostUrl = $requestNode->xpath('BrowserFormPost/URL')[0];

        $this->parseEntrinsic($requestNode);

        foreach ($requestNode->xpath('Contact') as $contactElement) {
            $contact = new Contact();
            $contact->parse($contactElement);
            $this->contact[] = $contact;
        }
    }

    public function getOperation(): ?string
    {
        return $this->operation;
    }

    public function setOperation(?string $operation): self
    {
        $this->operation = $operation;
        return $this;
    }

    public function getBuyerCookie(): ?string
    {
        return $this->buyerCookie;
    }

    public function setBuyerCookie(?string $buyerCookie): self
    {
        $this->buyerCookie = $buyerCookie;
        return $this;
    }

    public function getBrowserFormPostUrl(): ?string
    {
        return $this->browserFormPostUrl;
    }

    public function setBrowserFormPostUrl(?string $browserFormPostUrl): self
    {
        $this->browserFormPostUrl = $browserFormPostUrl;
        return $this;
    }

    /**
     * @return \CXml\Models\Messages\Contact[]
     */
    public function getContact(): array
    {
        return $this->contact;
    }

    /**
     * @param \CXml\Models\Messages\Contact[] $contact
     *
     * @return PunchOutSetupRequest
     */
    public function setContact(array $contact): PunchOutSetupRequest
    {
        $this->contact = $contact;
        return $this;
    }
}
