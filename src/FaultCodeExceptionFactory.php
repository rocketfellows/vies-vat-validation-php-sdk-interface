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
use rocketfellows\ViesVatValidationInterface\exceptions\service\VatNumberValidationServiceException;

class FaultCodeExceptionFactory
{
    private const DEFAULT_EXCEPTION_MESSAGE = '';

    public function create(string $faultCode, ?string $message = null): VatNumberValidationServiceException
    {
        $message = empty($message) ? self::DEFAULT_EXCEPTION_MESSAGE : $message;

        switch ($faultCode) {
            case FaultCodes::INVALID_INPUT:
                return new InvalidInputServiceException($message);
            case FaultCodes::SERVICE_UNAVAILABLE:
                return new ServiceUnavailableException($message);
            case FaultCodes::MS_UNAVAILABLE:
                return new MSUnavailableServiceException($message);
            case FaultCodes::TIMEOUT:
                return new TimeoutServiceException($message);
            case FaultCodes::INVALID_REQUESTER_INFO:
                return new InvalidRequesterInfoServiceException($message);
            case FaultCodes::VAT_BLOCKED:
                return new VatBlockedServiceException($message);
            case FaultCodes::IP_BLOCKED:
                return new IPBlockedServiceException($message);
            case FaultCodes::GLOBAL_MAX_CONCURRENT_REQ:
                return new GlobalMaxConcurrentReqServiceException($message);
            case FaultCodes::GLOBAL_MAX_CONCURRENT_REQ_TIME:
                return new GlobalMaxConcurrentReqTimeServiceException($message);
            case FaultCodes::MS_MAX_CONCURRENT_REQ:
                return new MSMaxConcurrentReqServiceException($message);
            case FaultCodes::MS_MAX_CONCURRENT_REQ_TIME:
                return new MSMaxConcurrentReqTimeServiceException($message);
            default:
                return new UnknownServiceErrorException($faultCode, $message);
        }
    }
}
