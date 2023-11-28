<?php

namespace rocketfellows\ViesVatValidationInterface;

use DateTime;
use Exception;

class VatNumberValidationResult
{
    private $vatNumber;
    private $requestDate;
    private $isValid;
    private $name;
    private $address;

    public function __construct(
        VatNumber $vatNumber,
        string $requestDate,
        bool $isValid,
        ?string $name = null,
        ?string $address = null
    ) {
        $this->vatNumber = $vatNumber;
        $this->requestDate = $requestDate;
        $this->isValid = $isValid;
        $this->name = $name;
        $this->address = $address;
    }

    public static function create(): self
    {

    }

    public function getVatNumber(): string
    {
        return $this->vatNumber->getVatNumber();
    }

    public function getCountryCode(): string
    {
        return $this->vatNumber->getCountryCode();
    }

    public function getRequestDateString(): string
    {
        return $this->requestDate;
    }

    public function getRequestDate(): ?DateTime
    {
        try {
            return !empty($this->getRequestDateString()) ? new DateTime($this->getRequestDateString()) : null;
        } catch (Exception $exception) {
            return null;
        }
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }
}
