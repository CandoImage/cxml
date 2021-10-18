<?php

namespace CXml\Models;

trait AttributesParserTrait
{

    /**
     * Iterates over a given set of attributes and if the attribute exists on
     * the provided SimpleXMLElement it is set as variable on the current object
     * instance - named like the attribute itself.
     *
     * @param \SimpleXMLElement $requestNode
     * @param iterable $attributesToSet
     */
    public function parseAttributes(\SimpleXMLElement $requestNode, iterable $attributesToSet): void
    {
        if ($nodeAttributes = $requestNode->attributes()) {
            foreach ($attributesToSet as $attribute) {
                if (isset($nodeAttributes[$attribute])) {
                    $this->{$attribute} = (string) $nodeAttributes[$attribute];
                }
            }
        }
    }
}
