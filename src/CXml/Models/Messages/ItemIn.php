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
     * @var string Product name
     */
    private $description;

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

    public function setDescription(string $description): self
    {
        $this->description = $description;
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
        $node->addAttribute('quantity', $this->quantity);

        // ItemID
        $itemIdNode = $node->addChild('ItemID');
        $itemIdNode->addChild('SupplierPartID', $this->supplierPartId);

        if ($this->supplierPartAuxiliaryID) {
            $itemIdNode->addChild('SupplierPartAuxiliaryID', $this->supplierPartAuxiliaryID);
        }

        // ItemDetails
        $itemDetailsNode = $node->addChild('ItemDetail');

        // UnitPrice
        $unitPrice = new Money();
        $unitPrice->setAmount($this->unitPrice);
        $unitPrice->setCurrency($this->unitPriceCurrency);
        $unitPrice->render($itemDetailsNode->addChild('UnitPrice'));

        // Description
        $description = $itemDetailsNode->addChild('Description', $this->description);
        if ($locale) {
            $description->addAttribute('xml:xml:lang', $locale);
        }

        // UnitOfMeasure
        $itemDetailsNode->addChild('UnitOfMeasure', $this->unitOfMeasure);

        // Classification
        $itemDetailsNode->addChild('Classification', $this->classification)
            ->addAttribute('domain', $this->classificationDomain);

        // Manufacturer
        $itemDetailsNode->addChild('ManufacturerPartID', $this->manufacturerPartId);
        $itemDetailsNode->addChild('ManufacturerName', $this->manufacturerName);

        // LeadTime
        if ($this->leadTime !== null) {
            $itemDetailsNode->addChild('LeadTime', $this->leadTime);
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
