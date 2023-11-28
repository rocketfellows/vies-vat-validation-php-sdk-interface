<?php

namespace rocketfellows\ViesVatValidationInterface;

use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;

interface VatNumberValidationServiceInterface
{
    /**
     * @throws InvalidInputServiceException
     */
    public function validateVat(VatNumber $vatNumber): VatNumberValidationResult;
}
