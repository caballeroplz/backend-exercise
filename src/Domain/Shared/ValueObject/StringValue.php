<?php
namespace App\Domain\Shared\ValueObject;

use Stringable;
use Exception;

class StringValue implements Stringable
{
    private $value;

    public function __construct(string $value, int $maxLength = null)
    {
        if ($maxLength && strlen($value) > $maxLength) {
            throw new Exception('The value exceeds the maximum length allowed: ' . $maxLength, 2);
        }

        $this->value = $value;
    }
    public function getValue(): ?string
    {
        return $this->value;
    }

    public function __toString(): string
    {
        return $this->getValue();
    }
}
