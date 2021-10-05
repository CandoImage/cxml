<?php

namespace CXml\Models;

trait EntrinsicTrait
{
    /** @var string[] */
    private $extrinsic = [];

    /** @noinspection PhpUndefinedFieldInspection */
    public function parseEntrinsic(\SimpleXMLElement $requestNode): void
    {
        foreach ($requestNode->xpath('Extrinsic') as $extrinsic) {
            $this->extrinsic[(string) $extrinsic->attributes()->name] = (string) $extrinsic;
        }
    }

    /**
     * Return extrinsic value.
     *
     * @param $name
     *
     * @return string|null
     */
    public function getExtrinsic($name) {
        if (isset($this->extrinsic[$name])) {
            return $this->extrinsic[$name];
        }
        return null;
    }
}
