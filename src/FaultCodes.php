<?php

namespace rocketfellows\ViesVatValidationInterface;

interface FaultCodes
{
    public const INVALID_INPUT = 'INVALID_INPUT';
    public const SERVICE_UNAVAILABLE = 'SERVICE_UNAVAILABLE';
    public const MS_UNAVAILABLE = 'MS_UNAVAILABLE';
    public const TIMEOUT = 'TIMEOUT';
}
