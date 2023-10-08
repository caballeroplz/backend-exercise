<?php

namespace App\Domain\Beer\ValueObject;

use Exception;

class FirstBrewed
{
    //As the format of 'firstbrewed' can change,
    //I'll implement it as a string instead of a date.
    private string $date;

    public function __construct(string $date)
    {
        $this->validateDateFormat($date);
        $this->date = $date;
    }

    public function getValue(): string
    {
        return $this->date;
    }
    
    private function validateDateFormat(string $date): void
    {
        if (!preg_match('/^(?:\d{2}\/\d{4}|\d{4})$/', $date)) {
            throw new Exception('The first brewed date format is not valid.', 3);
        }
    }
}
