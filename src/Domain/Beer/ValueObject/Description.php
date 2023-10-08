<?php

namespace App\Domain\Beer\ValueObject;

use App\Domain\Shared\ValueObject\StringValue;

class Description extends StringValue
{
    public function __construct(string $value)
    {
        parent::__construct($value);
    }
}
