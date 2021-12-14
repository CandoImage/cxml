<?php


namespace CXml\Models\Messages;


class PunchOutOrderMessageHeader
{
    /**
     * @var float
     */
    private $totalAmount;

    /**
     * @var float|null
     */
    private $shippingCost;

    /**
     * @var string
     */
    private $shippingDescription;

    /**
     * @var float
     */
    private $taxSum;

    /**
     * @var string
     */
    private $taxDescription;

    public function getTotalAmount(): float
    {
        return $this->totalAmount;
    }

    public function setTotalAmount(float $totalAmount): self
    {
        $this->totalAmount = $totalAmount;
        return $this;
    }

    public function getShippingCost(): ?float
    {
        return $this->shippingCost;
    }

    public function setShippingCost(?float $shippingCost): self
    {
        $this->shippingCost = $shippingCost;
        return $this;
    }

    public function getShippingDescription(): string
    {
        return $this->shippingDescription;
    }

    public function setShippingDescription(string $shippingDescription): self
    {
        $this->shippingDescription = $shippingDescription;
        return $this;
    }

    public function getTaxSum(): float
    {
        return $this->taxSum;
    }

    public function setTaxSum(float $taxSum): self
    {
        $this->taxSum = $taxSum;
        return $this;
    }

    public function getTaxDescription(): string
    {
        return $this->taxDescription;
    }

    public function setTaxDescription(string $taxDescription): self
    {
        $this->taxDescription = $taxDescription;
        return $this;
    }

    public function render(\SimpleXMLElement $parentNode, string $currency, string $locale): void
    {
        $node = $parentNode->addChild('PunchOutOrderMessageHeader');
        $node->addAttribute('operationAllowed', 'create');

        // Total
        $this->addPriceNode($node, 'Total', $currency, $this->totalAmount);

        // Shipping
        if (!is_null($this->shippingCost)) {
            $this->addPriceNode($node, 'Shipping', $currency, $this->shippingCost, $this->shippingDescription, $locale);
        }

        // Tax
        if (!is_null($this->taxSum)) {
            $this->addPriceNode($node, 'Tax', $currency, $this->taxSum, $this->taxDescription, $locale);
        }
    }

    private function addPriceNode(\SimpleXMLElement $parentNode, string $name, string $currency, float $priceValue, string $description = null, string $locale = null)
    {
        $node = $parentNode->addChild($name);

        $money = new Money();
        $money->setAmount($priceValue);
        $money->setCurrency($currency);
        $money->render($node);

        if ($description !== null) {
            $node->addChild('Description', htmlspecialchars($description, ENT_XML1 | ENT_COMPAT, 'UTF-8'))
                ->addAttribute('xml:xml:lang', $locale);
        }
    }
}
