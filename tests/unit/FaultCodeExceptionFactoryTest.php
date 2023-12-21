<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use Exception;
use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSUnavailableServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\ServiceUnavailableException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\TimeoutServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\VatBlockedServiceException;

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
            'fault code TIMEOUT' => [
                'faultCode' => 'TIMEOUT',
                'expectedCreatedException' => new TimeoutServiceException(),
            ],
            'fault code INVALID_REQUESTER_INFO' => [
                'faultCode' => 'INVALID_REQUESTER_INFO',
                'expectedCreatedException' => new InvalidRequesterInfoServiceException(),
            ],
            'fault code VAT_BLOCKED' => [
                'faultCode' => 'VAT_BLOCKED',
                'expectedCreatedException' => new VatBlockedServiceException(),
            ],
        ];
    }
}
