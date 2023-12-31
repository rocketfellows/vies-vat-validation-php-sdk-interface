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
use rocketfellows\ViesVatValidationInterface\exceptions\ServiceRequestException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\CountryCodeAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\RequestDateAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\ValidationFlagAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\VatNumberAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\VatOwnerAddressAttributeNotFoundException;
use rocketfellows\ViesVatValidationInterface\exceptions\validationResult\VatOwnerNameAttributeNotFoundException;

interface VatNumberValidationServiceInterface
{
    /**
     * @throws InvalidInputServiceException
     * @throws InvalidRequesterInfoServiceException
     * @throws ServiceUnavailableException
     * @throws MSUnavailableServiceException
     * @throws TimeoutServiceException
     * @throws VatBlockedServiceException
     * @throws IPBlockedServiceException
     * @throws GlobalMaxConcurrentReqServiceException
     * @throws GlobalMaxConcurrentReqTimeServiceException
     * @throws MSMaxConcurrentReqServiceException
     * @throws MSMaxConcurrentReqTimeServiceException
     * @throws UnknownServiceErrorException
     * @throws ServiceRequestException
     * @throws CountryCodeAttributeNotFoundException
     * @throws RequestDateAttributeNotFoundException
     * @throws ValidationFlagAttributeNotFoundException
     * @throws VatNumberAttributeNotFoundException
     * @throws VatOwnerAddressAttributeNotFoundException
     * @throws VatOwnerNameAttributeNotFoundException
     */
    public function validateVat(VatNumber $vatNumber): VatNumberValidationResult;
}
