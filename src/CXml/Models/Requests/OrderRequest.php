<?php

namespace CXml\Models\Requests;

use CXml\Models\AttributesParserTrait;
use CXml\Models\Messages\BillTo;
use CXml\Models\Messages\Contact;
use CXml\Models\EntrinsicTrait;
use CXml\Models\Messages\ItemOut;
use CXml\Models\Messages\ShipTo;

class OrderRequest implements RequestInterface
{
    use EntrinsicTrait;
    use AttributesParserTrait;

    protected $orderID;
    protected $orderDate;
    protected $orderVersion;

    /**
     * Type of order:
     * - regular
     * - release
     * - blanket
     * - stockTransport
     * - stockTransportRelease
     *
     * @var
     */
    protected $orderType = 'regular';

    /**
     * Type of request: new, update, delete
     *
     * @var string
     */
    protected $type;

    /**
     * @var float|null
     */
    protected $total;

    /**
     * @var string|null
     */
    protected $currency;

    /**
     * @var ShipTo|null
     */
    protected $shipTo;

    /**
     * @var BillTo|null
     */
    protected $billTo;

    protected $shipping;
    protected $tax;

    /**
     * @var \CXml\Models\Messages\Contact
     */
    protected $contact;

    /**
     * @var \CXml\Models\Messages\ItemOut[]
     */
    protected $itemOut = [];

    /**
     * @noinspection PhpUndefinedFieldInspection
     */
    public function parse(\SimpleXMLElement $requestNode): void
    {

        $this->parseAttributes(
            current($requestNode->xpath('OrderRequestHeader')), [
            'orderID',
            'orderDate',
            'orderType',
            'orderVersion',
            'type',
            ]
        );

        $this->parseAttributes(
            current($requestNode->xpath('OrderRequestHeader/Total/Money')), [
            'currency',
            ]
        );

        $this->parseEntrinsic($requestNode);

        foreach ($requestNode->xpath('ItemOut') as $itemOutElement) {
            $itemOut = new ItemOut();
            $itemOut->parse($itemOutElement);
            $this->itemOut[] = $itemOut;
        }

        if ($contactElement = current($requestNode->xpath('OrderRequestHeader/Contact'))) {
            $this->contact = new Contact();
            $this->contact->parse($contactElement);
        }
        if ($node = current($requestNode->xpath('OrderRequestHeader/BillTo'))) {
            $this->billTo = new BillTo();
            $this->billTo->parse($node);
        }
        if ($node = current($requestNode->xpath('OrderRequestHeader/ShipTo'))) {
            $this->shipTo = new ShipTo();
            $this->shipTo->parse($node);
        }
        $totalMoney          = $requestNode->xpath('OrderRequestHeader/Total/Money');
        $this->total = (string) current($totalMoney);
        $this->shipping = (string) current($requestNode->xpath('OrderRequestHeader/Shipping/Money'));
        $this->tax      = (string) current($requestNode->xpath('OrderRequestHeader/Tax/Money'));
    }

    /**
     * @return mixed
     */
    public function getOrderId()
    {
        return $this->orderID;
    }

    /**
     * @param mixed $orderId
     *
     * @return OrderRequest
     */
    public function setOrderId($orderId)
    {
        $this->orderID = $orderId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderDate()
    {
        return $this->orderDate;
    }

    /**
     * @param mixed $orderDate
     *
     * @return OrderRequest
     */
    public function setOrderDate($orderDate)
    {
        $this->orderDate = $orderDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return OrderRequest
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderType()
    {
        return $this->orderType;
    }

    /**
     * @param mixed $type
     *
     * @return OrderRequest
     */
    public function setOrderType($orderType)
    {
        $this->orderType = $orderType;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getTotal(): ?float
    {
        return $this->total;
    }

    /**
     * @param float|null $total
     *
     * @return OrderRequest
     */
    public function setTotal(?float $total): OrderRequest
    {
        $this->total = $total;
        return $this;
    }

    /**
     * @return ShipTo|null
     */
    public function getShipTo(): ?ShipTo
    {
        return $this->shipTo;
    }

    /**
     * @param ShipTo|null $shipTo
     *
     * @return OrderRequest
     */
    public function setShipTo(?ShipTo $shipTo): OrderRequest
    {
        $this->shipTo = $shipTo;
        return $this;
    }

    /**
     * @return BillTo|null
     */
    public function getBillTo(): ?BillTo
    {
        return $this->billTo;
    }

    /**
     * @param BillTo|null $billTo
     *
     * @return OrderRequest
     */
    public function setBillTo(?BillTo $billTo): OrderRequest
    {
        $this->billTo = $billTo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getBusinessPartner()
    {
        return $this->businessPartner;
    }

    /**
     * @param mixed $businessPartner
     *
     * @return OrderRequest
     */
    public function setBusinessPartner($businessPartner)
    {
        $this->businessPartner = $businessPartner;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLegalEntity()
    {
        return $this->legalEntity;
    }

    /**
     * @param mixed $legalEntity
     *
     * @return OrderRequest
     */
    public function setLegalEntity($legalEntity)
    {
        $this->legalEntity = $legalEntity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrganizationUnit()
    {
        return $this->organizationUnit;
    }

    /**
     * @param mixed $organizationUnit
     *
     * @return OrderRequest
     */
    public function setOrganizationUnit($organizationUnit)
    {
        $this->organizationUnit = $organizationUnit;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param mixed $shipping
     *
     * @return OrderRequest
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTax()
    {
        return $this->tax;
    }

    /**
     * @param mixed $tax
     *
     * @return OrderRequest
     */
    public function setTax($tax)
    {
        $this->tax = $tax;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param mixed $payment
     *
     * @return OrderRequest
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymentTerm()
    {
        return $this->paymentTerm;
    }

    /**
     * @param mixed $paymentTerm
     *
     * @return OrderRequest
     */
    public function setPaymentTerm($paymentTerm)
    {
        $this->paymentTerm = $paymentTerm;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * @param mixed $comments
     *
     * @return OrderRequest
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getFollowup()
    {
        return $this->followup;
    }

    /**
     * @param mixed $followup
     *
     * @return OrderRequest
     */
    public function setFollowup($followup)
    {
        $this->followup = $followup;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getControlKeys()
    {
        return $this->controlKeys;
    }

    /**
     * @param mixed $controlKeys
     *
     * @return OrderRequest
     */
    public function setControlKeys($controlKeys)
    {
        $this->controlKeys = $controlKeys;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDocumentReference()
    {
        return $this->documentReference;
    }

    /**
     * @param mixed $documentReference
     *
     * @return OrderRequest
     */
    public function setDocumentReference($documentReference)
    {
        $this->documentReference = $documentReference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSupplierOrderInfo()
    {
        return $this->supplierOrderInfo;
    }

    /**
     * @param mixed $supplierOrderInfo
     *
     * @return OrderRequest
     */
    public function setSupplierOrderInfo($supplierOrderInfo)
    {
        $this->supplierOrderInfo = $supplierOrderInfo;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTermsOfDelivery()
    {
        return $this->termsOfDelivery;
    }

    /**
     * @param mixed $termsOfDelivery
     *
     * @return OrderRequest
     */
    public function setTermsOfDelivery($termsOfDelivery)
    {
        $this->termsOfDelivery = $termsOfDelivery;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDeliveryPeriod()
    {
        return $this->deliveryPeriod;
    }

    /**
     * @param mixed $deliveryPeriod
     *
     * @return OrderRequest
     */
    public function setDeliveryPeriod($deliveryPeriod)
    {
        $this->deliveryPeriod = $deliveryPeriod;
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
     * @return OrderRequest
     */
    public function setIdReference($idReference)
    {
        $this->idReference = $idReference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderRequestHeaderIndustry()
    {
        return $this->orderRequestHeaderIndustry;
    }

    /**
     * @param mixed $orderRequestHeaderIndustry
     *
     * @return OrderRequest
     */
    public function setOrderRequestHeaderIndustry($orderRequestHeaderIndustry)
    {
        $this->orderRequestHeaderIndustry = $orderRequestHeaderIndustry;
        return $this;
    }

    /**
     * @return \CXml\Models\Messages\Contact
     */
    public function getContact(): Contact
    {
        return $this->contact;
    }

    /**
     * @param \CXml\Models\Messages\Contact $contact
     *
     * @return OrderRequest
     */
    public function setContact(Contact $contact): OrderRequest
    {
        $this->contact = $contact;
        return $this;
    }

    /**
     * @return \CXml\Models\Messages\ItemOut[]
     */
    public function getItemOut(): array
    {
        return $this->itemOut;
    }

    /**
     * @param \CXml\Models\Messages\ItemOut[] $itemOut
     *
     * @return OrderRequest
     */
    public function setItemOut(array $itemOut): OrderRequest
    {
        $this->itemOut = $itemOut;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderVersion()
    {
        return $this->orderVersion;
    }

    /**
     * @param mixed $orderVersion
     */
    public function setOrderVersion($orderVersion): void
    {
        $this->orderVersion = $orderVersion;
    }

    /**
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
    }

    /**
     * @param string|null $currency
     */
    public function setCurrency(?string $currency): void
    {
        $this->currency = $currency;
    }

}
