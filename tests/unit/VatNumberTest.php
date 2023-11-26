<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use PHPUnit\Framework\TestCase;

/**
 * @group vies-vat-validation-interface
 */
class VatNumberTest extends TestCase
{
    /**
     * @dataProvider getVatNumberProvidedData
     */
    public function testCreateNewVatNumber(string $countryCode, string $vatNumberValue): void
    {
        $vatNumber = new VatNumber($countryCode, $vatNumberValue);

        $this->assertEquals($countryCode, $vatNumber->getCountryCode());
        $this->assertEquals($vatNumberValue, $vatNumber->getVatNumber());
    }

    public function getVatNumberProvidedData(): array
    {
        return [
            'country code not empty, vat number not empty' => [
                'countryCode' => 'DE',
                'vatNumberValue' => 'foo1234bar',
            ],
            'country code empty, vat number empty' => [
                'countryCode' => '',
                'vatNumberValue' => '',
            ],
        ];
    }
}
