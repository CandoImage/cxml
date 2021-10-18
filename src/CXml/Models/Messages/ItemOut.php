<?php

namespace CXml\Models\Messages;

use CXml\Models\AttributesParserTrait;
use CXml\Models\Requests\RequestInterface;

class ItemOut implements RequestInterface
{

    use AttributesParserTrait;

    /**
     * Required Properties
     */

    // Attributes
    protected $quantity;
    protected $lineNumber;
    // Elements
    protected $itemIdSupplierPartID;
    protected $itemIdSupplierPartAuxiliaryID;
    protected $itemIdBuyerPartID;
    protected $itemIdIdReference;

    /**
     * Optional Properties
     */

    // Attributes
    protected $requisitionID;
    protected $agreementItemNumber;
    protected $requestedDeliveryDate;
    protected $isAdHoc;
    protected $parentLineNumber;
    protected $itemType;
    protected $requiresServiceEntry;
    protected $confirmationDueDate;
    protected $compositeItemType;
    protected $itemClassification;
    protected $serviceitemCategory;
    protected $subcontractingType;
    protected $stockTransferType;
    protected $requestedShipmentDate;
    protected $isReturn;
    protected $returnAuthorizationNumber;
    protected $isDeliveryCompleted;
    protected $unlimitedDelivery;
    protected $isItemChanged;
    protected $isKanban;
    protected $stoDelivery;
    protected $stoOrderCombination;
    protected $stoFinalDelivery;

    // Elements
    /**
     * @var \CXml\Models\Messages\ShipTo 
     */
    protected $shipTo;
    protected $shipping;
    protected $tax;
    /**
     * @var \CXml\Models\Messages\Contact 
     */
    protected $contact;

    public function parse(\SimpleXMLElement $requestNode)
    {
        $attributes = [
            'quantity',
            'lineNumber',
            'requisitionID',
            'agreementItemNumber',
            'requestedDeliveryDate',
            'isAdHoc',
            'parentLineNumber',
            'itemType',
            'requiresServiceEntry',
            'confirmationDueDate',
            'compositeItemType',
            'itemClassification',
            'serviceitemCategory',
            'subcontractingType',
            'stockTransferType',
            'requestedShipmentDate',
            'isReturn',
            'returnAuthorizationNumber',
            'isDeliveryCompleted',
            'unlimitedDelivery',
            'isItemChanged',
            'isKanban',
            'stoDelivery',
            'stoOrderCombination',
            'stoFinalDelivery',
        ];
        $this->parseAttributes($requestNode, $attributes);

        if ($node = current($requestNode->xpath('/ShipTo'))) {
            $this->shipTo = new ShipTo();
            $this->shipTo->parse($node);
        }

        if ($node = current($requestNode->xpath('/Contact'))) {
            $this->contact = new Contact();
            $this->contact->parse($node);
        }

        if ($node = current($requestNode->xpath('/ItemID/SupplierPartID'))) {
            $this->itemIdSupplierPartID = (string) $node;
        }
        if ($node = current($requestNode->xpath('/ItemID/SupplierPartAuxiliaryID'))) {
            $this->itemIdSupplierPartAuxiliaryID = (string) $node;
        }
        if ($node = current($requestNode->xpath('/ItemID/BuyerPartID'))) {
            $this->itemIdBuyerPartID = (string) $node;
        }
        if ($node = current($requestNode->xpath('/ItemID/IdReference'))) {
            $this->itemIdIdReference = (string) $node;
        }
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     *
     * @return ItemOut
     */
    public function setQuantity($quantity): self
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLineNumber()
    {
        return $this->lineNumber;
    }

    /**
     * @param mixed $lineNumber
     *
     * @return ItemOut
     */
    public function setLineNumber($lineNumber): self
    {
        $this->lineNumber = $lineNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemIdSupplierPartID()
    {
        return $this->itemIdSupplierPartID;
    }

    /**
     * @param mixed $itemIdSupplierPartID
     *
     * @return ItemOut
     */
    public function setItemIdSupplierPartID($itemIdSupplierPartID): self
    {
        $this->itemIdSupplierPartID = $itemIdSupplierPartID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemIdSupplierPartAuxiliaryID()
    {
        return $this->itemIdSupplierPartAuxiliaryID;
    }

    /**
     * @param mixed $itemIdSupplierPartAuxiliaryID
     *
     * @return ItemOut
     */
    public function setItemIdSupplierPartAuxiliaryID(
        $itemIdSupplierPartAuxiliaryID
    ): self {
        $this->itemIdSupplierPartAuxiliaryID = $itemIdSupplierPartAuxiliaryID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemIdBuyerPartID()
    {
        return $this->itemIdBuyerPartID;
    }

    /**
     * @param mixed $itemIdBuyerPartID
     *
     * @return ItemOut
     */
    public function setItemIdBuyerPartID($itemIdBuyerPartID): self
    {
        $this->itemIdBuyerPartID = $itemIdBuyerPartID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemIdIdReference()
    {
        return $this->itemIdIdReference;
    }

    /**
     * @param mixed $itemIdIdReference
     *
     * @return ItemOut
     */
    public function setItemIdIdReference($itemIdIdReference): self
    {
        $this->itemIdIdReference = $itemIdIdReference;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequisitionID()
    {
        return $this->requisitionID;
    }

    /**
     * @param mixed $requisitionID
     *
     * @return ItemOut
     */
    public function setRequisitionID($requisitionID): self
    {
        $this->requisitionID = $requisitionID;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAgreementItemNumber()
    {
        return $this->agreementItemNumber;
    }

    /**
     * @param mixed $agreementItemNumber
     *
     * @return ItemOut
     */
    public function setAgreementItemNumber($agreementItemNumber): self
    {
        $this->agreementItemNumber = $agreementItemNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestedDeliveryDate()
    {
        return $this->requestedDeliveryDate;
    }

    /**
     * @param mixed $requestedDeliveryDate
     *
     * @return ItemOut
     */
    public function setRequestedDeliveryDate($requestedDeliveryDate): self
    {
        $this->requestedDeliveryDate = $requestedDeliveryDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsAdHoc()
    {
        return $this->isAdHoc;
    }

    /**
     * @param mixed $isAdHoc
     *
     * @return ItemOut
     */
    public function setIsAdHoc($isAdHoc): self
    {
        $this->isAdHoc = $isAdHoc;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getParentLineNumber()
    {
        return $this->parentLineNumber;
    }

    /**
     * @param mixed $parentLineNumber
     *
     * @return ItemOut
     */
    public function setParentLineNumber($parentLineNumber): self
    {
        $this->parentLineNumber = $parentLineNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemType()
    {
        return $this->itemType;
    }

    /**
     * @param mixed $itemType
     *
     * @return ItemOut
     */
    public function setItemType($itemType): self
    {
        $this->itemType = $itemType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequiresServiceEntry()
    {
        return $this->requiresServiceEntry;
    }

    /**
     * @param mixed $requiresServiceEntry
     *
     * @return ItemOut
     */
    public function setRequiresServiceEntry($requiresServiceEntry): self
    {
        $this->requiresServiceEntry = $requiresServiceEntry;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfirmationDueDate()
    {
        return $this->confirmationDueDate;
    }

    /**
     * @param mixed $confirmationDueDate
     *
     * @return ItemOut
     */
    public function setConfirmationDueDate($confirmationDueDate): self
    {
        $this->confirmationDueDate = $confirmationDueDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCompositeItemType()
    {
        return $this->compositeItemType;
    }

    /**
     * @param mixed $compositeItemType
     *
     * @return ItemOut
     */
    public function setCompositeItemType($compositeItemType): self
    {
        $this->compositeItemType = $compositeItemType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getItemClassification()
    {
        return $this->itemClassification;
    }

    /**
     * @param mixed $itemClassification
     *
     * @return ItemOut
     */
    public function setItemClassification($itemClassification): self
    {
        $this->itemClassification = $itemClassification;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceitemCategory()
    {
        return $this->serviceitemCategory;
    }

    /**
     * @param mixed $serviceitemCategory
     *
     * @return ItemOut
     */
    public function setServiceitemCategory($serviceitemCategory): self
    {
        $this->serviceitemCategory = $serviceitemCategory;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubcontractingType()
    {
        return $this->subcontractingType;
    }

    /**
     * @param mixed $subcontractingType
     *
     * @return ItemOut
     */
    public function setSubcontractingType($subcontractingType): self
    {
        $this->subcontractingType = $subcontractingType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStockTransferType()
    {
        return $this->stockTransferType;
    }

    /**
     * @param mixed $stockTransferType
     *
     * @return ItemOut
     */
    public function setStockTransferType($stockTransferType): self
    {
        $this->stockTransferType = $stockTransferType;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequestedShipmentDate()
    {
        return $this->requestedShipmentDate;
    }

    /**
     * @param mixed $requestedShipmentDate
     *
     * @return ItemOut
     */
    public function setRequestedShipmentDate($requestedShipmentDate): self
    {
        $this->requestedShipmentDate = $requestedShipmentDate;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsReturn()
    {
        return $this->isReturn;
    }

    /**
     * @param mixed $isReturn
     *
     * @return ItemOut
     */
    public function setIsReturn($isReturn): self
    {
        $this->isReturn = $isReturn;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getReturnAuthorizationNumber()
    {
        return $this->returnAuthorizationNumber;
    }

    /**
     * @param mixed $returnAuthorizationNumber
     *
     * @return ItemOut
     */
    public function setReturnAuthorizationNumber($returnAuthorizationNumber): self
    {
        $this->returnAuthorizationNumber = $returnAuthorizationNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsDeliveryCompleted()
    {
        return $this->isDeliveryCompleted;
    }

    /**
     * @param mixed $isDeliveryCompleted
     *
     * @return ItemOut
     */
    public function setIsDeliveryCompleted($isDeliveryCompleted): self
    {
        $this->isDeliveryCompleted = $isDeliveryCompleted;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getUnlimitedDelivery()
    {
        return $this->unlimitedDelivery;
    }

    /**
     * @param mixed $unlimitedDelivery
     *
     * @return ItemOut
     */
    public function setUnlimitedDelivery($unlimitedDelivery): self
    {
        $this->unlimitedDelivery = $unlimitedDelivery;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsItemChanged()
    {
        return $this->isItemChanged;
    }

    /**
     * @param mixed $isItemChanged
     *
     * @return ItemOut
     */
    public function setIsItemChanged($isItemChanged): self
    {
        $this->isItemChanged = $isItemChanged;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getIsKanban()
    {
        return $this->isKanban;
    }

    /**
     * @param mixed $isKanban
     *
     * @return ItemOut
     */
    public function setIsKanban($isKanban): self
    {
        $this->isKanban = $isKanban;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoDelivery()
    {
        return $this->stoDelivery;
    }

    /**
     * @param mixed $stoDelivery
     *
     * @return ItemOut
     */
    public function setStoDelivery($stoDelivery): self
    {
        $this->stoDelivery = $stoDelivery;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoOrderCombination()
    {
        return $this->stoOrderCombination;
    }

    /**
     * @param mixed $stoOrderCombination
     *
     * @return ItemOut
     */
    public function setStoOrderCombination($stoOrderCombination): self
    {
        $this->stoOrderCombination = $stoOrderCombination;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getStoFinalDelivery()
    {
        return $this->stoFinalDelivery;
    }

    /**
     * @param mixed $stoFinalDelivery
     *
     * @return ItemOut
     */
    public function setStoFinalDelivery($stoFinalDelivery): self
    {
        $this->stoFinalDelivery = $stoFinalDelivery;
        return $this;
    }

    /**
     * @return \CXml\Models\Messages\ShipTo
     */
    public function getShipTo(): ShipTo
    {
        return $this->shipTo;
    }

    /**
     * @param \CXml\Models\Messages\ShipTo $shipTo
     *
     * @return ItemOut
     */
    public function setShipTo(ShipTo $shipTo): self
    {
        $this->shipTo = $shipTo;
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
     * @return ItemOut
     */
    public function setShipping($shipping): self
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
     * @return ItemOut
     */
    public function setTax($tax): self
    {
        $this->tax = $tax;
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
     * @return ItemOut
     */
    public function setContact(Contact $contact): self
    {
        $this->contact = $contact;
        return $this;
    }

}
