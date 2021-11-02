<?php

namespace CXml\Models\Messages;

use CXml\Models\Requests\RequestInterface;

class SelectedItem implements RequestInterface
{
    /**
     * @var \CXml\Models\Messages\ItemId
     */
    private $itemID;

    public function parse(\SimpleXMLElement $requestNode): void
    {
        // TODO: Implement parse() method.
        $this->itemID = new ItemId();
        $this->itemID->parse(current($requestNode->xpath('ItemID')));
    }
}
