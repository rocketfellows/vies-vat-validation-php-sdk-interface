<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\VatNumber;

/**
 * @group vies-vat-validation-interface
 */
class VatNumberValidationResultTest extends TestCase
{
    /**
     * @dataProvider getVatNumberValidationResultProvidedData
     */
    public function testCreateNewVatNumberValidationResult(array $resultData, array $expectedData): void
    {
        $vatNumberValidationResult = new VatNumberValidationResult(
            $resultData['vatNumber'],
            $resultData['requestDate'],
            $resultData['isValid'],
            $resultData['name'],
            $resultData['address'],
        );

        $this->assertEquals($expectedData['countryCode'], $vatNumberValidationResult->getCountryCode());
        $this->assertEquals($expectedData['vatNumber'], $vatNumberValidationResult->getVatNumber());
        $this->assertEquals($expectedData['requestDate'], $vatNumberValidationResult->getRequestDate());
        $this->assertEquals($expectedData['requestDateString'], $vatNumberValidationResult->getRequestDateString());
        $this->assertEquals($expectedData['isValid'], $vatNumberValidationResult->isValid());
        $this->assertEquals($expectedData['name'], $vatNumberValidationResult->getName());
        $this->assertEquals($expectedData['address'], $vatNumberValidationResult->getAddress());
    }

    public function getVatNumberValidationResultProvidedData(): array
    {
        return [
            'request date set, vat is valid, name set, address set' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('DE', 'foo'),
                    'requestDate' => '2023-11-26 23:23:23',
                    'isValid' => true,
                    'name' => 'some name',
                    'address' => 'some address',
                ],
                'expectedData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => 'foo',
                    'requestDate' => new DateTime('2023-11-26 23:23:23'),
                    'requestDateString' => '2023-11-26 23:23:23',
                    'isValid' => true,
                    'name' => 'some name',
                    'address' => 'some address',
                ],
            ],
            'request date set, vat is invalid, name set, address set' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('DE', 'foo'),
                    'requestDate' => '2023-11-26 23:23:23',
                    'isValid' => false,
                    'name' => 'some name',
                    'address' => 'some address',
                ],
                'expectedData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => 'foo',
                    'requestDate' => new DateTime('2023-11-26 23:23:23'),
                    'requestDateString' => '2023-11-26 23:23:23',
                    'isValid' => false,
                    'name' => 'some name',
                    'address' => 'some address',
                ],
            ],
            'request date empty, vat is valid, name empty, address empty' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('DE', 'foo'),
                    'requestDate' => '',
                    'isValid' => true,
                    'name' => '',
                    'address' => '',
                ],
                'expectedData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => 'foo',
                    'requestDate' => null,
                    'requestDateString' => '',
                    'isValid' => true,
                    'name' => '',
                    'address' => '',
                ],
            ],
            'request date invalid, vat is valid, name empty, address empty' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('DE', 'foo'),
                    'requestDate' => 'foo',
                    'isValid' => true,
                    'name' => '',
                    'address' => '',
                ],
                'expectedData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => 'foo',
                    'requestDate' => null,
                    'requestDateString' => 'foo',
                    'isValid' => true,
                    'name' => '',
                    'address' => '',
                ],
            ],
            'request date empty, vat is valid, name not set, address not set' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('DE', 'foo'),
                    'requestDate' => '',
                    'isValid' => true,
                    'name' => null,
                    'address' => null,
                ],
                'expectedData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => 'foo',
                    'requestDate' => null,
                    'requestDateString' => '',
                    'isValid' => true,
                    'name' => null,
                    'address' => null,
                ],
            ],
            'request date empty, vat is valid, name not set, address set' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('DE', 'foo'),
                    'requestDate' => '',
                    'isValid' => true,
                    'name' => null,
                    'address' => null,
                ],
                'expectedData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => 'foo',
                    'requestDate' => null,
                    'requestDateString' => '',
                    'isValid' => true,
                    'name' => null,
                    'address' => 'some address',
                ],
            ],
        ];
    }
}
