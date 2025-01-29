<?php

namespace CXml\Models\Messages;

use CXml\Models\Requests\RequestInterface;

class PostalAddress implements RequestInterface, MessageInterface
{

    /**
     * Required Properties
     */

    private $country;
    private $city;
    /**
     * @var string[]
     */
    private $street = [];

    /**
     * Optional Properties
     */

    private $isoCountryCode;

    /**
     * @var string[]
     */
    private $deliverTo = [];
    private $municipality;
    private $state;
    private $postalCode;

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    public function getISOCountryCode()
    {
        return $this->isoCountryCode;
    }

    /**
     * @param string $country
     *
     * @return PostalAddress
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     *
     * @return PostalAddress
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getStreet(): array
    {
        return $this->street;
    }

    /**
     * @param string[] $street
     *
     * @return PostalAddress
     */
    public function setStreet(array $street): PostalAddress
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getDeliverTo(): array
    {
        return $this->deliverTo;
    }

    /**
     * @param string[] $deliverTo
     *
     * @return PostalAddress
     */
    public function setDeliverTo(array $deliverTo): PostalAddress
    {
        $this->deliverTo = $deliverTo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMunicipality()
    {
        return $this->municipality;
    }

    /**
     * @param string|null $municipality
     *
     * @return PostalAddress
     */
    public function setMunicipality($municipality)
    {
        $this->municipality = $municipality;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string|null $state
     *
     * @return PostalAddress
     */
    public function setState($state)
    {
        $this->state = $state;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string|null $postalCode
     *
     * @return PostalAddress
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
        return $this;
    }

    public function parse(\SimpleXMLElement $contactXml): void
    {
        if ($data = $contactXml->xpath('Country')) {
            $current = current($data);

            $attr = $current->attributes();

            if ($attr && isset($attr->isoCountryCode)) {
                $this->isoCountryCode = (string)$attr->isoCountryCode;
            }

            $this->country = (string)$current;
        }
        if ($data = $contactXml->xpath('City')) {
            $this->city = (string)current($data);
        }
        if ($data = $contactXml->xpath('Street')) {
            foreach ($data as $street) {
                $this->street[] = (string)$street;
            }
        }

        if ($data = $contactXml->xpath('DeliverTo')) {
            foreach ($data as $deliverTo) {
                $this->deliverTo[] = (string)$deliverTo;
            }
        }
        if ($data = $contactXml->xpath('Municipality')) {
            $this->municipality = (string)current($data);
        }
        if ($data = $contactXml->xpath('State')) {
            $this->state = (string)current($data);
        }
        if ($data = $contactXml->xpath('PostalCode')) {
            $this->postalCode = (string)current($data);
        }
    }

    public function render(\SimpleXMLElement $parentNode): void
    {
        if ($this->country) {
            $parentNode->addChild('Country', htmlspecialchars($this->country, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
        if ($this->city) {
            $parentNode->addChild('City', htmlspecialchars($this->city, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
        if ($this->street) {
            foreach ($this->street as $street) {
                $parentNode->addChild('Street', htmlspecialchars($street, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
            }
        }
        if ($this->deliverTo) {
            foreach ($this->deliverTo as $deliverTo) {
                $parentNode->addChild('DeliverTo', htmlspecialchars($deliverTo, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
            }
        }
        if ($this->municipality) {
            $parentNode->addChild('Municipality', htmlspecialchars($this->municipality, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
        if ($this->state) {
            $parentNode->addChild('State', htmlspecialchars($this->state, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
        if ($this->postalCode) {
            $parentNode->addChild('PostalCode', htmlspecialchars($this->postalCode, ENT_XML1 | ENT_COMPAT, 'UTF-8'));
        }
    }
}
