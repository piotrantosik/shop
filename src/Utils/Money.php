<?php

namespace App\Utils;

class Money
{
    private $locale;

    public function __construct(string $locale)
    {
        $this->locale = $locale;
    }

    public function getCurrency(): string
    {
        $format = new \NumberFormatter('en_' . $this->locale, \NumberFormatter::CURRENCY);

        return $format->getTextAttribute(\NumberFormatter::CURRENCY_CODE);
    }
}
