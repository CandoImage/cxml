<?php

namespace CXml\Models\Requests;

use CXml\Models\EntrinsicTrait;

class ProfileRequest implements RequestInterface
{
    use EntrinsicTrait;

    /**
     * @noinspection PhpUndefinedFieldInspection 
     */
    public function parse(\SimpleXMLElement $requestNode): void
    {
        $this->parseEntrinsic($requestNode);
    }
}
