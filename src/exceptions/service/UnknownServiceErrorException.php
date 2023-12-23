<?php

namespace rocketfellows\ViesVatValidationInterface\exceptions\service;

use Throwable;

class UnknownServiceErrorException extends VatNumberValidationServiceException
{
    private $faultCode;

    public function __construct(
        string $faultCode,
        string $message = "",
        int $code = 0,
        Throwable $previous = null
    ) {
        parent::__construct($message, $code, $previous);

        $this->faultCode = $faultCode;
    }

    public function getFaultCode(): string
    {
        return $this->faultCode;
    }
}
