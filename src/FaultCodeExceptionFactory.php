<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\service\UnknownServiceErrorException;
use rocketfellows\ViesVatValidationInterface\exceptions\VatNumberValidationException;

class FaultCodeExceptionFactory
{
    public function create(string $faultCode): VatNumberValidationException
    {
        // TODO: implement

        return new UnknownServiceErrorException();
    }
}
