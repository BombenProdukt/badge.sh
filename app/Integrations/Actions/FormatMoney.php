<?php

declare(strict_types=1);

namespace App\Integrations\Actions;

use Money\Currencies\ISOCurrencies;
use Money\Currency;
use Money\Formatter\IntlMoneyFormatter;
use Money\Money;

final class FormatMoney
{
    public static function execute(float|int|string $amount, string $currency): string
    {
        if (is_float($amount)) {
            $amount = intval($amount * 100);
        }

        $money      = (new Money($amount, new Currency($currency)));
        $currencies = new ISOCurrencies;

        $numberFormatter = new \NumberFormatter('en_US', \NumberFormatter::CURRENCY);
        $moneyFormatter  = new IntlMoneyFormatter($numberFormatter, $currencies);

        return $moneyFormatter->format($money);
    }
}
