<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSUnavailableServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\ServiceUnavailableException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\TimeoutServiceException;

interface VatNumberValidationServiceInterface
{
    /**
     * @throws InvalidInputServiceException
     * @throws InvalidRequesterInfoServiceException
     * @throws ServiceUnavailableException
     * @throws MSUnavailableServiceException
     * @throws TimeoutServiceException
     */
    public function validateVat(VatNumber $vatNumber): VatNumberValidationResult;
}
