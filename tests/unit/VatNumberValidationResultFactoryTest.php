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
        VatNumberValidationResult $expectedVatNumberValidationResult
    ): void {
        $this->assertEquals(
            $expectedVatNumberValidationResult,
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
        ];
    }
}
