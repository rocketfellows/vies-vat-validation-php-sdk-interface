<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\VatNumber;

/**
 * @group vies-vat-validation-interface
 */
class VatNumberValidationResultTest extends TestCase
{
    public function getVatNumberValidationResultProvidedData(): array
    {
        return [
            'request date set, vat is valid, name set, address set' => [
                'vatNumber' => new VatNumber('DE', 'foo'),
                'requestDate' => '2023-11-26 23:23:23',
                'isValid' => true,
                'name' => 'some name',
                'address' => 'some address',
            ],
        ];
    }
}
