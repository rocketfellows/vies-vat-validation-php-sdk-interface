<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\ServiceUnavailableException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\UnknownServiceErrorException;
use rocketfellows\ViesVatValidationInterface\exceptions\VatNumberValidationException;

class FaultCodeExceptionFactory
{
    public function create(string $faultCode): VatNumberValidationException
    {
        // TODO: implement
        switch ($faultCode) {
            case FaultCodes::INVALID_INPUT:
                return new InvalidInputServiceException();
            case FaultCodes::SERVICE_UNAVAILABLE:
                return new ServiceUnavailableException();
            default:
                return new UnknownServiceErrorException();
        }
    }
}
