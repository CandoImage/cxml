<?php

namespace CXml\Models\Messages;


class ItemIn implements MessageInterface
{
    /**
     * @var int
     */
    private $quantity;

    /**
     * @var string Product SKU
     */
    private $supplierPartId;

    /**
     * @var string Id to enable order / cart restore
     */
    private $supplierPartAuxiliaryID;

    /**
     * @var float
     */
    private $unitPrice;

    /**
     * @var string
     */
    private $unitPriceCurrency;

    /**
     * @var string Description | Product Name
     *
     * If shortName is set will generated something like this - othweise it is
     * the main value.
     * <Description xml:lang="en-US">
     *   <ShortName>Mens Shoes</ShortName>
     *   Black shoes with velcro clasp
     * </Description>
     */
    private $description;

    /**
     * @var string Dedicated Product name to set in description.
     *
     * Will generate something like this:
     * <Description xml:lang="en-US">
     *   <ShortName>Mens Shoes</ShortName>
     *   Black shoes with velcro clasp
     * </Description>
     */
    private $shortName;

    /**
     * @var string Locale of description
     */
    private $locale;

    /**
     * @var string
     */
    private $unitOfMeasure;

    /**
     * @var string
     */
    private $classificationDomain;

    /**
     * @var string
     */
    private $classification;

    /**
     * @var string
     */
    private $manufacturerPartId;

    /**
     * @var string
     */
    private $manufacturerName;

    /**
     * @var int|null
     */
    private $leadTime;

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

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
    public function setSupplierPartAuxiliaryID(string $supplierPartAuxiliaryID): self
    {
        $this->supplierPartAuxiliaryID = $supplierPartAuxiliaryID;
        return $this;
    }

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(float $unitPrice): self
    {
        $this->unitPrice = $unitPrice;
        return $this;
    }

    public function getUnitPriceCurrency(): ?string
    {
        return $this->unitPriceCurrency;
    }

    public function setUnitPriceCurrency(string $unitPriceCurrency): self
    {
        $this->unitPriceCurrency = $unitPriceCurrency;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description, string $longDescription = null): self
    {
        if (!empty($longDescription)) {
            $this->description = $longDescription;
            $this->setShortName($description);
        } else {
            $this->description = $description;
            unset($this->shortName);
        }
        return $this;
    }

    public function getShortName(): string
    {
        return $this->shortName;
    }

    public function setShortName(string $shortName): self
    {
        $this->shortName = $shortName;
        return $this;
    }

    public function getUnitOfMeasure(): string
    {
        return $this->unitOfMeasure;
    }

    public function setUnitOfMeasure(string $unitOfMeasure): self
    {
        $this->unitOfMeasure = $unitOfMeasure;
        return $this;
    }

    public function getClassificationDomain(): string
    {
        return $this->classificationDomain;
    }

    public function setClassificationDomain(string $classificationDomain): self
    {
        $this->classificationDomain = $classificationDomain;
        return $this;
    }

    public function getClassification(): string
    {
        return $this->classification;
    }

    public function setClassification(string $classification): self
    {
        $this->classification = $classification;
        return $this;
    }

    public function getManufacturerPartId(): string
    {
        return $this->manufacturerPartId;
    }

    public function setManufacturerPartId(string $manufacturerPartId): self
    {
        $this->manufacturerPartId = $manufacturerPartId;
        return $this;
    }

    public function getManufacturerName(): string
    {
        return $this->manufacturerName;
    }

    public function setManufacturerName(string $manufacturerName): self
    {
        $this->manufacturerName = $manufacturerName;
        return $this;
    }

    public function render(\SimpleXMLElement $parentNode): void
    {
        $node = $parentNode->addChild('ItemIn');
        $node->addAttribute('quantity', htmlspecialchars($this->quantity, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        $locale = $this->getLocale();

        // ItemID
        $itemIdNode = $node->addChild('ItemID');
        $itemIdNode->addChild('SupplierPartID', htmlspecialchars($this->supplierPartId, ENT_XML1 | ENT_COMPAT, 'UTF-8'));

        if ($this->supplierPartAuxiliaryID) {
            $itemIdNode->addChild('SupplierPartAuxiliaryID', htmlspecialchars($this->supplierPartAuxiliaryID, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }

        // ItemDetails
        $itemDetailsNode = $node->addChild('ItemDetail');

        // UnitPrice
        $unitPrice = new Money();
        $unitPrice->setAmount($this->unitPrice);
        $unitPrice->setCurrency($this->unitPriceCurrency);
        $unitPrice->render($itemDetailsNode->addChild('UnitPrice'));

        // Description
        $descriptionValue = htmlspecialchars($this->description, ENT_XML1 | ENT_COMPAT, 'UTF-8');
        if (!empty($this->shortName)) {
            $descriptionValue = '<ShortName>' . htmlspecialchars($this->shortName, ENT_XML1 | ENT_COMPAT, 'UTF-8') . '</ShortName>' . $descriptionValue;
        }
        $description = $itemDetailsNode->addChild('Description', $descriptionValue);
        if ($locale) {
            $description->addAttribute('xml:xml:lang', $locale);
        }

        // UnitOfMeasure
        $itemDetailsNode->addChild('UnitOfMeasure', htmlspecialchars($this->unitOfMeasure, ENT_XML1 | ENT_COMPAT, 'UTF-8'));

        // Classification
        $itemDetailsNode->addChild('Classification', htmlspecialchars($this->classification, ENT_XML1 | ENT_COMPAT, 'UTF-8'))
            ->addAttribute('domain', htmlspecialchars($this->classificationDomain, ENT_XML1 | ENT_QUOTES, 'UTF-8'));

        // Manufacturer
        $itemDetailsNode->addChild('ManufacturerPartID', htmlspecialchars($this->manufacturerPartId, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        $itemDetailsNode->addChild('ManufacturerName', htmlspecialchars($this->manufacturerName, ENT_XML1 | ENT_COMPAT, 'UTF-8'));

        // LeadTime
        if ($this->leadTime !== null) {
            $itemDetailsNode->addChild('LeadTime', htmlspecialchars($this->leadTime, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
    }

    public function getLeadTime(): ?int
    {
        return $this->leadTime;
    }

    public function setLeadTime(?int $leadTime): self
    {
        $this->leadTime = $leadTime;
        return $this;
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
