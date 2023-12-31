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
     * @dataProvider getCreateExceptionWithoutMessageProvidedData
     */
    public function testCreateExceptionWithoutMessage(string $faultCode, Exception $expectedCreatedException): void
    {
        $this->assertEquals($expectedCreatedException, $this->faultCodeExceptionFactoryTest->create($faultCode));
    }

    public function getCreateExceptionWithoutMessageProvidedData(): array
    {
        return [
            'fault code INVALID_INPUT' => [
                'faultCode' => 'INVALID_INPUT',
                'expectedCreatedException' => new InvalidInputServiceException(),
            ],
            'fault code invalid_input' => [
                'faultCode' => 'invalid_input',
                'expectedCreatedException' => new InvalidInputServiceException(),
            ],
            'fault code SERVICE_UNAVAILABLE' => [
                'faultCode' => 'SERVICE_UNAVAILABLE',
                'expectedCreatedException' => new ServiceUnavailableException(),
            ],
            'fault code service_unavailable' => [
                'faultCode' => 'service_unavailable',
                'expectedCreatedException' => new ServiceUnavailableException(),
            ],
            'fault code MS_UNAVAILABLE' => [
                'faultCode' => 'MS_UNAVAILABLE',
                'expectedCreatedException' => new MSUnavailableServiceException(),
            ],
            'fault code ms_unavailable' => [
                'faultCode' => 'ms_unavailable',
                'expectedCreatedException' => new MSUnavailableServiceException(),
            ],
            'fault code TIMEOUT' => [
                'faultCode' => 'TIMEOUT',
                'expectedCreatedException' => new TimeoutServiceException(),
            ],
            'fault code timeout' => [
                'faultCode' => 'timeout',
                'expectedCreatedException' => new TimeoutServiceException(),
            ],
            'fault code INVALID_REQUESTER_INFO' => [
                'faultCode' => 'INVALID_REQUESTER_INFO',
                'expectedCreatedException' => new InvalidRequesterInfoServiceException(),
            ],
            'fault code invalid_requester_info' => [
                'faultCode' => 'invalid_requester_info',
                'expectedCreatedException' => new InvalidRequesterInfoServiceException(),
            ],
            'fault code VAT_BLOCKED' => [
                'faultCode' => 'VAT_BLOCKED',
                'expectedCreatedException' => new VatBlockedServiceException(),
            ],
            'fault code vat_blocked' => [
                'faultCode' => 'vat_blocked',
                'expectedCreatedException' => new VatBlockedServiceException(),
            ],
            'fault code IP_BLOCKED' => [
                'faultCode' => 'IP_BLOCKED',
                'expectedCreatedException' => new IPBlockedServiceException(),
            ],
            'fault code ip_blocked' => [
                'faultCode' => 'ip_blocked',
                'expectedCreatedException' => new IPBlockedServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ',
                'expectedCreatedException' => new GlobalMaxConcurrentReqServiceException(),
            ],
            'fault code global_max_concurrent_req' => [
                'faultCode' => 'global_max_concurrent_req',
                'expectedCreatedException' => new GlobalMaxConcurrentReqServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ_TIME' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ_TIME',
                'expectedCreatedException' => new GlobalMaxConcurrentReqTimeServiceException(),
            ],
            'fault code global_max_concurrent_req_time' => [
                'faultCode' => 'global_max_concurrent_req_time',
                'expectedCreatedException' => new GlobalMaxConcurrentReqTimeServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ',
                'expectedCreatedException' => new MSMaxConcurrentReqServiceException(),
            ],
            'fault code ms_max_concurrent_req' => [
                'faultCode' => 'ms_max_concurrent_req',
                'expectedCreatedException' => new MSMaxConcurrentReqServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ_TIME' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ_TIME',
                'expectedCreatedException' => new MSMaxConcurrentReqTimeServiceException(),
            ],
            'fault code ms_max_concurrent_req_time' => [
                'faultCode' => 'ms_max_concurrent_req_time',
                'expectedCreatedException' => new MSMaxConcurrentReqTimeServiceException(),
            ],
            'fault code unknown in upper case' => [
                'faultCode' => 'FOO_BAR',
                'expectedCreatedException' => new UnknownServiceErrorException('FOO_BAR'),
            ],
            'fault code unknown in lower case' => [
                'faultCode' => 'foo_bar',
                'expectedCreatedException' => new UnknownServiceErrorException('FOO_BAR'),
            ],
            'fault code empty' => [
                'faultCode' => '',
                'expectedCreatedException' => new UnknownServiceErrorException(''),
            ],
        ];
    }

    /**
     * @dataProvider getCreateExceptionWithMessageProvidedData
     */
    public function testCreateExceptionWithMessage(
        string $faultCode,
        ?string $message,
        Exception $expectedCreatedException
    ): void {
        $this->assertEquals(
            $expectedCreatedException,
            $this->faultCodeExceptionFactoryTest->create($faultCode, $message)
        );
    }

    public function getCreateExceptionWithMessageProvidedData(): array
    {
        return [
            'fault code INVALID_INPUT, message empty' => [
                'faultCode' => 'INVALID_INPUT',
                'message' => '',
                'expectedCreatedException' => new InvalidInputServiceException(),
            ],
            'fault code INVALID_INPUT, message not empty' => [
                'faultCode' => 'INVALID_INPUT',
                'message' => 'foo',
                'expectedCreatedException' => new InvalidInputServiceException('foo'),
            ],
            'fault code INVALID_INPUT, message is null' => [
                'faultCode' => 'INVALID_INPUT',
                'message' => null,
                'expectedCreatedException' => new InvalidInputServiceException(),
            ],
            'fault code SERVICE_UNAVAILABLE, message empty' => [
                'faultCode' => 'SERVICE_UNAVAILABLE',
                'message' => '',
                'expectedCreatedException' => new ServiceUnavailableException(),
            ],
            'fault code SERVICE_UNAVAILABLE, message not empty' => [
                'faultCode' => 'SERVICE_UNAVAILABLE',
                'message' => 'foo',
                'expectedCreatedException' => new ServiceUnavailableException('foo'),
            ],
            'fault code SERVICE_UNAVAILABLE, message is null' => [
                'faultCode' => 'SERVICE_UNAVAILABLE',
                'message' => null,
                'expectedCreatedException' => new ServiceUnavailableException(),
            ],
            'fault code MS_UNAVAILABLE, message empty' => [
                'faultCode' => 'MS_UNAVAILABLE',
                'message' => '',
                'expectedCreatedException' => new MSUnavailableServiceException(),
            ],
            'fault code MS_UNAVAILABLE, message not empty' => [
                'faultCode' => 'MS_UNAVAILABLE',
                'message' => 'foo',
                'expectedCreatedException' => new MSUnavailableServiceException('foo'),
            ],
            'fault code MS_UNAVAILABLE, message is null' => [
                'faultCode' => 'MS_UNAVAILABLE',
                'message' => null,
                'expectedCreatedException' => new MSUnavailableServiceException(),
            ],
            'fault code TIMEOUT, message empty' => [
                'faultCode' => 'TIMEOUT',
                'message' => '',
                'expectedCreatedException' => new TimeoutServiceException(),
            ],
            'fault code TIMEOUT, message not empty' => [
                'faultCode' => 'TIMEOUT',
                'message' => 'foo',
                'expectedCreatedException' => new TimeoutServiceException('foo'),
            ],
            'fault code TIMEOUT, message is null' => [
                'faultCode' => 'TIMEOUT',
                'message' => null,
                'expectedCreatedException' => new TimeoutServiceException(),
            ],
            'fault code INVALID_REQUESTER_INFO, message empty' => [
                'faultCode' => 'INVALID_REQUESTER_INFO',
                'message' => '',
                'expectedCreatedException' => new InvalidRequesterInfoServiceException(),
            ],
            'fault code INVALID_REQUESTER_INFO, message not empty' => [
                'faultCode' => 'INVALID_REQUESTER_INFO',
                'message' => 'foo',
                'expectedCreatedException' => new InvalidRequesterInfoServiceException('foo'),
            ],
            'fault code INVALID_REQUESTER_INFO, message is null' => [
                'faultCode' => 'INVALID_REQUESTER_INFO',
                'message' => null,
                'expectedCreatedException' => new InvalidRequesterInfoServiceException(),
            ],
            'fault code VAT_BLOCKED, message empty' => [
                'faultCode' => 'VAT_BLOCKED',
                'message' => '',
                'expectedCreatedException' => new VatBlockedServiceException(),
            ],
            'fault code VAT_BLOCKED, message not empty' => [
                'faultCode' => 'VAT_BLOCKED',
                'message' => 'foo',
                'expectedCreatedException' => new VatBlockedServiceException('foo'),
            ],
            'fault code VAT_BLOCKED, message is null' => [
                'faultCode' => 'VAT_BLOCKED',
                'message' => null,
                'expectedCreatedException' => new VatBlockedServiceException(),
            ],
            'fault code IP_BLOCKED, message empty' => [
                'faultCode' => 'IP_BLOCKED',
                'message' => '',
                'expectedCreatedException' => new IPBlockedServiceException(),
            ],
            'fault code IP_BLOCKED, message not empty' => [
                'faultCode' => 'IP_BLOCKED',
                'message' => 'foo',
                'expectedCreatedException' => new IPBlockedServiceException('foo'),
            ],
            'fault code IP_BLOCKED, message is null' => [
                'faultCode' => 'IP_BLOCKED',
                'message' => null,
                'expectedCreatedException' => new IPBlockedServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ, message empty' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ',
                'message' => '',
                'expectedCreatedException' => new GlobalMaxConcurrentReqServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ, message not empty' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ',
                'message' => 'foo',
                'expectedCreatedException' => new GlobalMaxConcurrentReqServiceException('foo'),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ, message is null' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ',
                'message' => null,
                'expectedCreatedException' => new GlobalMaxConcurrentReqServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ_TIME, message empty' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ_TIME',
                'message' => '',
                'expectedCreatedException' => new GlobalMaxConcurrentReqTimeServiceException(),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ_TIME, message not empty' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ_TIME',
                'message' => 'foo',
                'expectedCreatedException' => new GlobalMaxConcurrentReqTimeServiceException('foo'),
            ],
            'fault code GLOBAL_MAX_CONCURRENT_REQ_TIME, message is null' => [
                'faultCode' => 'GLOBAL_MAX_CONCURRENT_REQ_TIME',
                'message' => null,
                'expectedCreatedException' => new GlobalMaxConcurrentReqTimeServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ, message empty' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ',
                'message' => '',
                'expectedCreatedException' => new MSMaxConcurrentReqServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ, message not empty' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ',
                'message' => 'foo',
                'expectedCreatedException' => new MSMaxConcurrentReqServiceException('foo'),
            ],
            'fault code MS_MAX_CONCURRENT_REQ, message is null' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ',
                'message' => null,
                'expectedCreatedException' => new MSMaxConcurrentReqServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ_TIME, message empty' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ_TIME',
                'message' => '',
                'expectedCreatedException' => new MSMaxConcurrentReqTimeServiceException(),
            ],
            'fault code MS_MAX_CONCURRENT_REQ_TIME, message not empty' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ_TIME',
                'message' => 'foo',
                'expectedCreatedException' => new MSMaxConcurrentReqTimeServiceException('foo'),
            ],
            'fault code MS_MAX_CONCURRENT_REQ_TIME, message is null' => [
                'faultCode' => 'MS_MAX_CONCURRENT_REQ_TIME',
                'message' => null,
                'expectedCreatedException' => new MSMaxConcurrentReqTimeServiceException(),
            ],
            'fault code unknown, message empty' => [
                'faultCode' => 'foo_bar',
                'message' => '',
                'expectedCreatedException' => new UnknownServiceErrorException('FOO_BAR'),
            ],
            'fault code unknown, message is null' => [
                'faultCode' => 'foo_bar',
                'message' => null,
                'expectedCreatedException' => new UnknownServiceErrorException('FOO_BAR'),
            ],
            'fault code unknown, message not empty' => [
                'faultCode' => 'foo_bar',
                'message' => 'foo',
                'expectedCreatedException' => new UnknownServiceErrorException('FOO_BAR', 'foo'),
            ],
            'fault code empty, message empty' => [
                'faultCode' => '',
                'message' => '',
                'expectedCreatedException' => new UnknownServiceErrorException(''),
            ],
            'fault code empty, message is null' => [
                'faultCode' => '',
                'message' => null,
                'expectedCreatedException' => new UnknownServiceErrorException(''),
            ],
            'fault code empty, message not empty' => [
                'faultCode' => '',
                'message' => 'foo',
                'expectedCreatedException' => new UnknownServiceErrorException('', 'foo'),
            ],
        ];
    }
}
