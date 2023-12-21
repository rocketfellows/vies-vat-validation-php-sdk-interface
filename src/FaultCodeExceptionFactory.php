<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\service\GlobalMaxConcurrentReqServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\GlobalMaxConcurrentReqTimeServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\IPBlockedServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSMaxConcurrentReqServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSMaxConcurrentReqTimeServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSUnavailableServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\ServiceUnavailableException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\TimeoutServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\UnknownServiceErrorException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\VatBlockedServiceException;
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
            case FaultCodes::MS_UNAVAILABLE:
                return new MSUnavailableServiceException();
            case FaultCodes::TIMEOUT:
                return new TimeoutServiceException();
            case FaultCodes::INVALID_REQUESTER_INFO:
                return new InvalidRequesterInfoServiceException();
            case FaultCodes::VAT_BLOCKED:
                return new VatBlockedServiceException();
            case FaultCodes::IP_BLOCKED:
                return new IPBlockedServiceException();
            case FaultCodes::GLOBAL_MAX_CONCURRENT_REQ:
                return new GlobalMaxConcurrentReqServiceException();
            case FaultCodes::GLOBAL_MAX_CONCURRENT_REQ_TIME:
                return new GlobalMaxConcurrentReqTimeServiceException();
            case FaultCodes::MS_MAX_CONCURRENT_REQ:
                return new MSMaxConcurrentReqServiceException();
            case FaultCodes::MS_MAX_CONCURRENT_REQ_TIME:
                return new MSMaxConcurrentReqTimeServiceException();
            default:
                return new UnknownServiceErrorException();
        }
    }
}
