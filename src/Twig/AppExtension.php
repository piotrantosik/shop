<?php

namespace App\Twig;

use Money\Formatter\IntlMoneyFormatter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    private $moneyFormatter;

    public function __construct(IntlMoneyFormatter $moneyFormatter)
    {
        $this->moneyFormatter = $moneyFormatter;
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('money_localized_format', [$this->moneyFormatter, 'format'], ['is_safe' => ['html']]),
        ];
    }
}
