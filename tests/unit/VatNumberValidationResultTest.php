<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use DateTime;
use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\VatNumber;
use rocketfellows\ViesVatValidationInterface\VatNumberValidationResult;

/**
 * @group vies-vat-validation-interface
 */
class VatNumberValidationResultTest extends TestCase
{
    /**
     * @dataProvider getVatNumberValidationResultProvidedData
     */
    public function testCreate(array $resultData, array $expectedData): void
    {
        $actualVatNumberValidationResult = VatNumberValidationResult::create(
            $resultData['vatNumber'],
            $resultData['requestDate'],
            $resultData['isValid'],
            $resultData['name'],
            $resultData['address'],
        );

        $this->assertEqualsExpectedVatNumberValidationResult($expectedData, $actualVatNumberValidationResult);
    }

    /**
     * @dataProvider getVatNumberValidationResultProvidedData
     */
    public function testCreateNewVatNumberValidationResult(array $resultData, array $expectedData): void
    {
        $actualVatNumberValidationResult = new VatNumberValidationResult(
            $resultData['vatNumber'],
            $resultData['requestDate'],
            $resultData['isValid'],
            $resultData['name'],
            $resultData['address'],
        );

        $this->assertEqualsExpectedVatNumberValidationResult($expectedData, $actualVatNumberValidationResult);
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
                    'address' => 'some address',
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
            'request date empty, vat is valid, name set, address not set' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('DE', 'foo'),
                    'requestDate' => '',
                    'isValid' => true,
                    'name' => 'some name',
                    'address' => null,
                ],
                'expectedData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => 'foo',
                    'requestDate' => null,
                    'requestDateString' => '',
                    'isValid' => true,
                    'name' => 'some name',
                    'address' => null,
                ],
            ],
            'country code not set, vat number not set, request date empty, vat is invalid, name not set, address not set' => [
                'resultData' => [
                    'vatNumber' => new VatNumber('', ''),
                    'requestDate' => '',
                    'isValid' => false,
                    'name' => null,
                    'address' => null,
                ],
                'expectedData' => [
                    'countryCode' => '',
                    'vatNumber' => '',
                    'requestDate' => null,
                    'requestDateString' => '',
                    'isValid' => false,
                    'name' => null,
                    'address' => null,
                ],
            ],
        ];
    }

    private function assertEqualsExpectedVatNumberValidationResult(
        array $expectedData,
        VatNumberValidationResult $actualVatNumberValidationResult
    ): void {
        $this->assertEquals($expectedData['countryCode'], $actualVatNumberValidationResult->getCountryCode());
        $this->assertEquals($expectedData['vatNumber'], $actualVatNumberValidationResult->getVatNumber());
        $this->assertEquals($expectedData['requestDate'], $actualVatNumberValidationResult->getRequestDate());
        $this->assertEquals($expectedData['requestDateString'], $actualVatNumberValidationResult->getRequestDateString());
        $this->assertEquals($expectedData['isValid'], $actualVatNumberValidationResult->isValid());
        $this->assertEquals($expectedData['name'], $actualVatNumberValidationResult->getName());
        $this->assertEquals($expectedData['address'], $actualVatNumberValidationResult->getAddress());
    }
}
