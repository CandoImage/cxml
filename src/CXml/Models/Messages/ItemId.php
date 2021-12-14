<?php

namespace CXml\Models\Messages;

use CXml\Models\Requests\RequestInterface;

class ItemId implements RequestInterface, MessageInterface
{

    /**
     * @var string Product SKU
     */
    protected $supplierPartId;

    /**
     * @var string Id to enable order / cart restore
     */
    protected $supplierPartAuxiliaryID;

    /**
     * @var string Id on buyer side.
     */
    protected $buyerPartID;

    public function getSupplierPartId(): string
    {
        return $this->supplierPartId;
    }

    public function setSupplierPartId(string $supplierPartId): self
    {
        $this->supplierPartId = $supplierPartId;
        return $this;
    }

    /**
     * @return string
     */
    public function getSupplierPartAuxiliaryID(): string
    {
        return $this->supplierPartAuxiliaryID;
    }

    /**
     * @param string $supplierPartAuxiliaryID
     *
     * @return ItemIn
     */
    public function setSupplierPartAuxiliaryID(?string $supplierPartAuxiliaryID): self
    {
        $this->supplierPartAuxiliaryID = $supplierPartAuxiliaryID;
        return $this;
    }

    /**
     * @return string
     */
    public function getBuyerPartID(): string
    {
        return $this->buyerPartID;
    }

    /**
     * @param string $buyerPartID
     *
     * @return ItemId
     */
    public function setBuyerPartID(?string $buyerPartID): self
    {
        $this->buyerPartID = $buyerPartID;
        return $this;
    }

    public function render(\SimpleXMLElement $parentNode): void
    {
        $node = $parentNode->addChild('ItemID');
        $locale = $this->getLocale();
        $node->addChild('SupplierPartID', htmlspecialchars($this->supplierPartId, ENT_XML1 | ENT_COMPAT, 'UTF-8'));

        if ($this->supplierPartAuxiliaryID) {
            $node->addChild('SupplierPartAuxiliaryID', htmlspecialchars($this->supplierPartAuxiliaryID, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
        if ($this->buyerPartID) {
            $node->addChild('BuyerPartID', htmlspecialchars($this->buyerPartID, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
    }

    public function parse(\SimpleXMLElement $requestNode): void
    {
        $this->supplierPartId = (string) current($requestNode->xpath('SupplierPartID'));

        if ($supplierPartAuxiliaryID = current($requestNode->xpath('SupplierPartAuxiliaryID'))) {
            $this->supplierPartAuxiliaryID = (string) $supplierPartAuxiliaryID;
        }
        if ($buyerPartID = current($requestNode->xpath('BuyerPartID'))) {
            $this->supplierPartAuxiliaryID = (string) $buyerPartID;
        }
    }

    public function getLocale(): ?string
    {
        return $this->locale;
    }

    public function setLocale(string $locale): self
    {
        $this->locale = $locale;
        return $this;
    }
}
