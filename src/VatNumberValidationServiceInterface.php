<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSUnavailableServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\ServiceUnavailableException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\TimeoutServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\VatBlockedServiceException;

interface VatNumberValidationServiceInterface
{
    /**
     * @throws InvalidInputServiceException
     * @throws InvalidRequesterInfoServiceException
     * @throws ServiceUnavailableException
     * @throws MSUnavailableServiceException
     * @throws TimeoutServiceException
     * @throws VatBlockedServiceException
     */
    public function validateVat(VatNumber $vatNumber): VatNumberValidationResult;
}
