<?php

namespace CXml\Models\Messages;

use CXml\Models\Requests\RequestInterface;

class Contact implements RequestInterface
{

    /**
     * Required Properties
     */

    private $name;

    /**
     * Optional Properties
     */

    /** @var \CXml\Models\Messages\PostalAddress[] */
    private $postalAddress = [];
    private $email;
    private $phone;
    private $fax;
    private $url;
    private $idReference;

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
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPostalAddress()
    {
        return $this->postalAddress;
    }

    /**
     * @param mixed $postalAddress
     *
     * @return Contact
     */
    public function setPostalAddress($postalAddress)
    {
        $this->postalAddress = $postalAddress;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     *
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @param mixed $fax
     *
     * @return Contact
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     *
     * @return Contact
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIdReference()
    {
        return $this->idReference;
    }

    /**
     * @param mixed $idReference
     *
     * @return Contact
     */
    public function setIdReference($idReference)
    {
        $this->idReference = $idReference;
        return $this;
    }

    public function parse(\SimpleXMLElement $contactXml) : void
    {
        foreach (['name', 'email', 'idReference', 'fax', 'phone', 'url'] as $key) {
            if ($data = $contactXml->xpath(ucfirst($key))) {
                $this->$key = (string) current($data);
            }
        }

        foreach ($contactXml->xpath('PostalAddress') as $postalAddressElement) {
            $postalAdress = new PostalAddress();
            $postalAdress->parse($postalAddressElement);
            $this->postalAddress[] = $postalAdress;
        }
    }
}
