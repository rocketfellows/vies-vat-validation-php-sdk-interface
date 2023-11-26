<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * @group vies-vat-validation-interface
 */
class VatNumberTest extends TestCase
{
    public function getVatNumberProvidedData(): array
    {
        return [
            'country code not empty, vat number not empty' => [
                'countryCode' => 'DE',
                'vatNumber' => 'foo1234bar',
            ],
        ];
    }
}
