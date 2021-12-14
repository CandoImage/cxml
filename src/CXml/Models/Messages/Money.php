<?php

namespace CXml\Models\Messages;

class Money implements MessageInterface
{
    /**
     * @var float
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var float
     */
    private $alternateAmount;

    /**
     * @var string
     */
    private $alternateCurrency;

    public function render(\SimpleXMLElement $parentNode): void
    {
        $amount = number_format($this->amount, 2, '.', '');
        $node = $parentNode->addChild('Money', htmlspecialchars($amount, ENT_XML1 | ENT_COMPAT, 'UTF-8'));

        $node->addAttribute('currency', htmlspecialchars($this->currency, ENT_XML1 | ENT_COMPAT, 'UTF-8'));

        if ($this->alternateAmount !== null) {
            $alternateAmount = number_format($this->alternateAmount, 2, '.', '');
            $node->addChild('alternateAmount', htmlspecialchars($alternateAmount, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
        if ($this->alternateCurrency !== null) {
            $node->addChild('alternateCurrency', htmlspecialchars($this->alternateCurrency, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @param float $amount
     *
     * @return Money
     */
    public function setAmount(float $amount): Money
    {
        $this->amount = $amount;
        return $this;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     *
     * @return Money
     */
    public function setCurrency(string $currency): Money
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return float
     */
    public function getAlternateAmount(): float
    {
        return $this->alternateAmount;
    }

    /**
     * @param float $alternateAmount
     *
     * @return Money
     */
    public function setAlternateAmount(float $alternateAmount): Money
    {
        $this->alternateAmount = $alternateAmount;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlternateCurrency(): string
    {
        return $this->alternateCurrency;
    }

    /**
     * @param string $alternateCurrency
     *
     * @return Money
     */
    public function setAlternateCurrency(string $alternateCurrency): Money
    {
        $this->alternateCurrency = $alternateCurrency;
        return $this;
    }


}
