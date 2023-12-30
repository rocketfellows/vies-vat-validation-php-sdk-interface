<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\VatNumberValidationResult;
use stdClass;

/**
 * @group vies-vat-validation-interface
 */
class VatNumberValidationResultFactoryTest extends TestCase
{
    private $vatNumberValidationResultFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vatNumberValidationResultFactory = new VatNumberValidationResultFactory();
    }

    /**
     * @dataProvider getVatNumberValidationResultCreateFromObjectProvidedData
     */
    public function testVatNumberValidationResultSuccessfullyCreatedFromObject(
        stdClass $rawData,
        array $expectedVatNumberValidationResultData
    ): void {
        $this->assertVatNumberValidationResultEqualExpected(
            $expectedVatNumberValidationResultData,
            $this->vatNumberValidationResultFactory->createFromObject($rawData)
        );
    }

    public function getVatNumberValidationResultCreateFromObjectProvidedData(): array
    {
        return [
            'all required attributes exists in camel case and set, vat is valid' => [
                'rawData' => (object) [
                    'countryCode' => 'DE',
                    'vatNumber' => '12312312',
                    'requestDate' => '2023-12-12 20:20:20',
                    'valid' => true,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => '12312312',
                    'requestDate' => '2023-12-12 20:20:20',
                    'valid' => true,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
            ],
            'all required attributes exists in camel case and set, vat is not valid' => [
                'rawData' => (object) [
                    'countryCode' => 'DE',
                    'vatNumber' => '12312312',
                    'requestDate' => '2023-12-12 20:20:20',
                    'valid' => false,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => '12312312',
                    'requestDate' => '2023-12-12 20:20:20',
                    'valid' => false,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
            ],
            'all required attributes exists in camel case and empty, vat is valid' => [
                'rawData' => (object) [
                    'countryCode' => '',
                    'vatNumber' => '',
                    'requestDate' => '',
                    'valid' => true,
                    'name' => '',
                    'address' => '',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => '',
                    'vatNumber' => '',
                    'requestDate' => '',
                    'valid' => true,
                    'name' => '',
                    'address' => '',
                ],
            ],
            'all required attributes exists in camel case and empty, vat is not valid' => [
                'rawData' => (object) [
                    'countryCode' => '',
                    'vatNumber' => '',
                    'requestDate' => '',
                    'valid' => false,
                    'name' => '',
                    'address' => '',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => '',
                    'vatNumber' => '',
                    'requestDate' => '',
                    'valid' => false,
                    'name' => '',
                    'address' => '',
                ],
            ],
            'all required attributes exists in snake case and set, vat is valid' => [
                'rawData' => (object) [
                    'country_code' => 'DE',
                    'vat_number' => '12312312',
                    'request_date' => '2023-12-12 20:20:20',
                    'valid' => true,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => '12312312',
                    'requestDate' => '2023-12-12 20:20:20',
                    'valid' => true,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
            ],
            'all required attributes exists in snake case and set, vat is not valid' => [
                'rawData' => (object) [
                    'country_code' => 'DE',
                    'vat_number' => '12312312',
                    'request_date' => '2023-12-12 20:20:20',
                    'valid' => false,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => 'DE',
                    'vatNumber' => '12312312',
                    'requestDate' => '2023-12-12 20:20:20',
                    'valid' => false,
                    'name' => 'fooBar',
                    'address' => 'barFoo',
                ],
            ],
            'all required attributes exists in snake case and empty, vat is valid' => [
                'rawData' => (object) [
                    'country_code' => '',
                    'vat_number' => '',
                    'request_date' => '',
                    'valid' => true,
                    'name' => '',
                    'address' => '',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => '',
                    'vatNumber' => '',
                    'requestDate' => '',
                    'valid' => true,
                    'name' => '',
                    'address' => '',
                ],
            ],
            'all required attributes exists in snake case and empty, vat is not valid' => [
                'rawData' => (object) [
                    'country_code' => '',
                    'vat_number' => '',
                    'request_date' => '',
                    'valid' => false,
                    'name' => '',
                    'address' => '',
                ],
                'expectedVatNumberValidationResultData' => [
                    'countryCode' => '',
                    'vatNumber' => '',
                    'requestDate' => '',
                    'valid' => false,
                    'name' => '',
                    'address' => '',
                ],
            ],
        ];
    }

    private function assertVatNumberValidationResultEqualExpected(
        array $expectedVatNumberValidationResultData,
        VatNumberValidationResult $actualVatNumberValidationResult
    ): void {
        $this->assertEquals(
            $expectedVatNumberValidationResultData['countryCode'],
            $actualVatNumberValidationResult->getCountryCode()
        );
        $this->assertEquals(
            $expectedVatNumberValidationResultData['vatNumber'],
            $actualVatNumberValidationResult->getVatNumber()
        );
        $this->assertEquals(
            $expectedVatNumberValidationResultData['requestDate'],
            $actualVatNumberValidationResult->getRequestDateString()
        );
        $this->assertEquals(
            $expectedVatNumberValidationResultData['valid'],
            $actualVatNumberValidationResult->isValid()
        );
        $this->assertEquals(
            $expectedVatNumberValidationResultData['name'],
            $actualVatNumberValidationResult->getName()
        );
        $this->assertEquals(
            $expectedVatNumberValidationResultData['address'],
            $actualVatNumberValidationResult->getAddress()
        );
    }
}
