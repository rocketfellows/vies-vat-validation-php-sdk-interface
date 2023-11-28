<?php

namespace rocketfellows\ViesVatValidationInterface;

interface VatNumberValidationServiceInterface
{
    public function validateVat(VatNumber $vatNumber): VatNumberValidationResult;
}
