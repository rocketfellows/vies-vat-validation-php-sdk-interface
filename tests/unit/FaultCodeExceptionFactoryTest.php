<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use PHPUnit\Framework\TestCase;

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
}
