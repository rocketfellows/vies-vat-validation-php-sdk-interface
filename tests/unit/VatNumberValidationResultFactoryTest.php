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
            [
                'rawData',
                'expectedVatNumberValidationResult',
            ],
        ];
    }
}
