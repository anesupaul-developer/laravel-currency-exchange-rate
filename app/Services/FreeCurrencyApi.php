<?php

namespace App\Services;

use App\CurrencyConverterInterface;
use App\Exceptions\CurrencyConversionException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FreeCurrencyApi implements CurrencyConverterInterface
{

    public function getRates(): mixed
    {
        return Cache::remember('latest_currencies', config('services.freecurrency.ttl'), function () {
            return Http::get(self::FREE_CURRENCY_END_POINT . '/latest', [
                'apikey' => config('services.freecurrency.key')
            ]);
        });
    }
    protected const FREE_CURRENCY_END_POINT = 'https://api.freecurrencyapi.com/v1/';

    /**
     * @throws CurrencyConversionException
     */
    public function convert(float $amount, string $fromCurrency, string $toCurrency): float
    {
        try {
            if (!in_array($fromCurrency, $this->allowedCurrencies())) {
                throw new CurrencyConversionException('Currency '. $fromCurrency. ' is not supported.');
            }

            if (!in_array($toCurrency, $this->allowedCurrencies())) {
                throw new CurrencyConversionException('Currency '. $toCurrency. ' is not supported.');
            }

            $rates = $this->getRates()->collect()->get('data');

            return round(($amount * $rates[$toCurrency])/$rates[$fromCurrency], 2, PHP_ROUND_HALF_DOWN);
        } catch (CurrencyConversionException $exception) {
            throw new CurrencyConversionException($exception->getMessage());
        }
    }

    public function allowedCurrencies(): array
    {
        return [
            "AUD", "BGN", "BRL", "CAD","CHF","CNY","CZK","DKK","EUR",
            "GBP","HKD","HRK", "HUF","IDR","ILS","INR","ISK","JPY","KRW",
            "MXN","MYR", "NOK","NZD","PHP","PLN","RON","RUB","SEK","SGD",
            "THB", "TRY","USD","ZAR"
        ];
    }
}
