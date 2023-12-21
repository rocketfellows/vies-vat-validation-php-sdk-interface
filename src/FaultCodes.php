<?php

namespace rocketfellows\ViesVatValidationInterface;

interface FaultCodes
{
    public const INVALID_INPUT = 'INVALID_INPUT';
    public const SERVICE_UNAVAILABLE = 'SERVICE_UNAVAILABLE';
    public const MS_UNAVAILABLE = 'MS_UNAVAILABLE';
    public const TIMEOUT = 'TIMEOUT';
    public const INVALID_REQUESTER_INFO = 'INVALID_REQUESTER_INFO';
    public const VAT_BLOCKED = 'VAT_BLOCKED';
    public const IP_BLOCKED = 'IP_BLOCKED';
    public const GLOBAL_MAX_CONCURRENT_REQ = 'GLOBAL_MAX_CONCURRENT_REQ';
    public const GLOBAL_MAX_CONCURRENT_REQ_TIME = 'GLOBAL_MAX_CONCURRENT_REQ_TIME';
}
