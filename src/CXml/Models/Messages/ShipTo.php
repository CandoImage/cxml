<?php

namespace CXml\Models;

use CXml\Models\Requests\RequestInterface;

class ShipTo implements RequestInterface
{

    /**
     * Required Properties
     */

    private $name;

    /**
     * Optional Properties
     */

    /** @var \CXml\Models\Messages\PostalAddress */
    private $address;

    protected $isoCountryCode;
    protected $addressId;
    protected $addressIdDomain;

    public function parse(\SimpleXMLElement $billToXml) {

        if ($data = (string) $billToXml->attributes()->isoCountryCode) {
            $this->isoCountryCode = $data;
        }
        if ($data = (string) $billToXml->attributes()->addressID) {
            $this->addressId = $data;
        }
        if ($data = (string) $billToXml->attributes()->addressIDDomain) {
            $this->addressIdDomain = $data;
        }

        $this->name = $billToXml->xpath('/Name')[0];

        if ($postalAddressElement = current($billToXml->xpath('/PostalAddress'))) {
            $this->address = new PostalAddress();
            $this->address->parse($postalAddressElement);
        }
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return BillTo
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return \CXml\Models\Messages\PostalAddress
     */
    public function getPostalAddress(): PostalAddress
    {
        return $this->postalAddress;
    }

    /**
     * @param \CXml\Models\Messages\PostalAddress $postalAddress
     *
     * @return BillTo
     */
    public function setPostalAddress(PostalAddress $postalAddress): BillTo
    {
        $this->postalAddress = $postalAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsoCountryCode()
    {
        return $this->isoCountryCode;
    }

    /**
     * @param mixed $isoCountryCode
     *
     * @return BillTo
     */
    public function setIsoCountryCode($isoCountryCode)
    {
        $this->isoCountryCode = $isoCountryCode;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * @param mixed $addressId
     *
     * @return BillTo
     */
    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddressIdDomain()
    {
        return $this->addressIdDomain;
    }

    /**
     * @param mixed $addressIdDomain
     *
     * @return BillTo
     */
    public function setAddressIdDomain($addressIdDomain)
    {
        $this->addressIdDomain = $addressIdDomain;
        return $this;
    }


}
