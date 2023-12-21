<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use Exception;
use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;

/**
 * @group vies-vat-validation-interface
 */
class FaultCodeExceptionFactoryTest extends TestCase
{
    private $faultCodeExceptionFactoryTest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faultCodeExceptionFactoryTest = new FaultCodeExceptionFactoryTest();
    }

    /**
     * @dataProvider getCreateExceptionProvidedData
     */
    public function testCreate(string $faultCode, Exception $expectedCreatedException): void
    {
        $this->assertEquals($expectedCreatedException, $this->faultCodeExceptionFactoryTest->create($faultCode));
    }

    public function getCreateExceptionProvidedData(): array
    {
        return [
            'fault code INVALID_INPUT' => [
                'faultCode' => 'INVALID_INPUT',
                'expectedCreatedException' => new InvalidInputServiceException(),
            ],
        ];
    }
}
