<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit\exceptions\service;

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
        ];
    }
}
