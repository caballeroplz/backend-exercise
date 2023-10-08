<?php

namespace App\Domain\Shared\ValueObject;

use Stringable;
use Exception;

class UniqueId implements Stringable
{
    private $value;

    public function __construct($value)
    {
        $this->validateValue($value);
        $this->value = $value;
    }

    public function getValue(): int
    {
        return $this->value;
    }

    private function validateValue($value): void
    {
        if (!is_int($value)) {
            throw new Exception('Id Value must be an integer', 1);
        }
    }

    public function __toString(): string
    {
        return (string) $this->getValue();
    }
}
