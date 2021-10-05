<?php

namespace CXml;

use CXml\Models\Requests\RequestInterface;

interface RequestFactoryInterface
{
    public function create(string $name) : RequestInterface
}
