<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use Exception;
use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\exceptions\service\GlobalMaxConcurrentReqServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\GlobalMaxConcurrentReqTimeServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidInputServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\InvalidRequesterInfoServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\IPBlockedServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSMaxConcurrentReqServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSMaxConcurrentReqTimeServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\MSUnavailableServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\ServiceUnavailableException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\TimeoutServiceException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\UnknownServiceErrorException;
use rocketfellows\ViesVatValidationInterface\exceptions\service\VatBlockedServiceException;
use rocketfellows\ViesVatValidationInterface\FaultCodeExceptionFactory;

/**
 * @group vies-vat-validation-interface
 */
class FaultCodeExceptionFactoryTest extends TestCase
{
    private $faultCodeExceptionFactoryTest;

    protected function setUp(): void
    {
        parent::setUp();

        $this->faultCodeExceptionFactoryTest = new FaultCodeExceptionFactory();
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
            'fault code IP_BLOCKED' => [
                'faultCode' => 'IP_BLOCKED',
                'expectedCreatedException' => new IPBlockedServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ',
                'expectedCreatedException' => new GlobalMaxConcurrentReqServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ_TIME' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ_TIME',
                'expectedCreatedException' => new GlobalMaxConcurrentReqTimeServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ',
                'expectedCreatedException' => new MSMaxConcurrentReqServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ_TIME' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ_TIME',
                'expectedCreatedException' => new MSMaxConcurrentReqTimeServiceException(),
            ],
            'fault code unknown' => [
                'faultCode' => 'foo_bar',
                'expectedCreatedException' => new UnknownServiceErrorException('foo_bar'),
            ],
            'fault code empty' => [
                'faultCode' => '',
                'expectedCreatedException' => new UnknownServiceErrorException(''),
            ],
        ];
    }
}
