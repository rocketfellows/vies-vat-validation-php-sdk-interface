<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit\exceptions\service;

use Exception;
use PHPUnit\Framework\TestCase;
use rocketfellows\ViesVatValidationInterface\exceptions\service\UnknownServiceErrorException;

/**
 * @group vies-vat-validation-interface
 */
class UnknownServiceErrorExceptionTest extends TestCase
{
    /**
     * @dataProvider getDefaultCreateExceptionProvidedData
     */
    public function testDefaultCreateException(array $exceptionData, array $expectedExceptionData): void
    {
        $exception = new UnknownServiceErrorException($exceptionData['faultCode']);

        $this->assertEquals($expectedExceptionData['expectedFaultCode'], $exception->getFaultCode());
        $this->assertEquals($expectedExceptionData['expectedMessage'], $exception->getMessage());
        $this->assertEquals($expectedExceptionData['expectedCode'], $exception->getCode());
        $this->assertEquals($expectedExceptionData['expectedPrevException'], $exception->getPrevious());
    }

    public function getDefaultCreateExceptionProvidedData(): array
    {
        return [
            'fault code empty' => [
                'exceptionData' => [
                    'faultCode' => '',
                ],
                'expectedExceptionData' => [
                    'expectedFaultCode' => '',
                    'expectedMessage' => '',
                    'expectedCode' => 0,
                    'expectedPrevException' => null,
                ],
            ],
            'fault code not empty' => [
                'exceptionData' => [
                    'faultCode' => 'foo',
                ],
                'expectedExceptionData' => [
                    'expectedFaultCode' => 'foo',
                    'expectedMessage' => '',
                    'expectedCode' => 0,
                    'expectedPrevException' => null,
                ],
            ],
        ];
    }

    /**
     * @dataProvider getCreateExceptionProvidedData
     */
    public function testCreateException(array $exceptionData, array $expectedExceptionData): void
    {
        $exception = new UnknownServiceErrorException(
            $exceptionData['faultCode'],
            $exceptionData['message'],
            $exceptionData['code'],
            $exceptionData['prevException']
        );

        $this->assertEquals($expectedExceptionData['expectedFaultCode'], $exception->getFaultCode());
        $this->assertEquals($expectedExceptionData['expectedMessage'], $exception->getMessage());
        $this->assertEquals($expectedExceptionData['expectedCode'], $exception->getCode());
        $this->assertEquals($expectedExceptionData['expectedPrevException'], $exception->getPrevious());
    }

    public function getCreateExceptionProvidedData(): array
    {
        $prevException = new Exception();

        return [
            'fault code empty, message empty, default code, prev exception not set' => [
                'exceptionData' => [
                    'faultCode' => '',
                    'message' => '',
                    'code' => 0,
                    'prevException' => null,
                ],
                'expectedExceptionData' => [
                    'expectedFaultCode' => '',
                    'expectedMessage' => '',
                    'expectedCode' => 0,
                    'expectedPrevException' => null,
                ],
            ],
            'fault code not empty, message not empty, not default code, prev exception set' => [
                'exceptionData' => [
                    'faultCode' => 'foo',
                    'message' => 'foo bar',
                    'code' => 1,
                    'prevException' => $prevException,
                ],
                'expectedExceptionData' => [
                    'expectedFaultCode' => 'foo',
                    'expectedMessage' => 'foo bar',
                    'expectedCode' => 1,
                    'expectedPrevException' => $prevException,
                ],
            ],
        ];
    }
}
