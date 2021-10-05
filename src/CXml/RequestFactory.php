<?php

namespace CXml;

use CXml\Models\Requests\PunchOutSetupRequest;
use CXml\Models\Requests\RequestInterface;

class RequestFactory implements RequestFactoryInterface
{
    public function create(string $name) : RequestInterface
    {
        switch ($name) {
            case 'PunchOutSetupRequest':
                return new PunchOutSetupRequest();
        }

        throw new \Exception("Request type '$name' is not supported");
    }
}
