<?php

namespace App\Services;

interface CurrencyConverterInterface
{
    public function getRates(): mixed;

    public function convert(float $amount, string $fromCurrency, string $toCurrency): float;

    public function allowedCurrencies(): array;
}
