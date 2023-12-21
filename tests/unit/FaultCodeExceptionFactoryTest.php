<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use Exception;
use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSUnavailableServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\ServiceUnavailableException;

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
            'fault code SERVICE_UNAVAILABLE' => [
                'faultCode' => 'SERVICE_UNAVAILABLE',
                'expectedCreatedException' => new ServiceUnavailableException(),
            ],
            'fault code MS_UNAVAILABLE' => [
                'faultCode' => 'MS_UNAVAILABLE',
                'expectedCreatedException' => new MSUnavailableServiceException(),
            ],
        ];
    }
}
