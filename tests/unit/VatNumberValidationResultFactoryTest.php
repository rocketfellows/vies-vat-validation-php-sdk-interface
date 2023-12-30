<?php

namespace rocketfellows\ViesVatValidationInterface\tests\unit;

use PHPUnit\Framework\TestCase;

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

    public function testVatNumberValidationResultSuccessfullyCreatedFromObject(): void
    {
        // TODO: implement
    }
}
