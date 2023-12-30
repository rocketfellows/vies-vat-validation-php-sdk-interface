<?php

namespace rocketfellows\ViesVatValidationInterface;

use stdClass;

class VatNumberValidationResultFactory
{
    public function createFromObject(stdClass $rawData): VatNumberValidationResult
    {
        // TODO: implement
        return VatNumberValidationResult::create();
    }

    public function createFromArray(array $rawData): VatNumberValidationResult
    {
        // TODO: implement
        return VatNumberValidationResult::create();
    }
}
