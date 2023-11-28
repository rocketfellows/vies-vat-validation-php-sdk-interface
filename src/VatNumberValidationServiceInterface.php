<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException;

interface VatNumberValidationServiceInterface
{
    /**
     * @throws InvalidInputServiceException
     * @throws InvalidRequesterInfoServiceException
     */
    public function validateVat(VatNumber $vatNumber): VatNumberValidationResult;
}
