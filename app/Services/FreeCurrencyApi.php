<?php

namespace App\Services;

use App\Exceptions\CurrencyConversionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class FreeCurrencyApi implements CurrencyConverterInterface
{

    private const FREE_CURRENCY_END_POINT = 'https://api.freecurrencyapi.com/v1/';

    public function getRates(): array
    {
        return Cache::remember('latest_currencies', config('services.freecurrency.ttl'), function () {
            $response = Http::get(self::FREE_CURRENCY_END_POINT . '/latest', [
                'apikey' => config('services.freecurrency.key')
            ]);

            return $response->collect()->get('data');
        });
    }

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

            $rates = $this->getRates();

            return round(($amount * $rates[$toCurrency])/$rates[$fromCurrency], 2, PHP_ROUND_HALF_DOWN);
        } catch (CurrencyConversionException $exception) {
            throw new CurrencyConversionException($exception->getMessage());
        }
    }

    public function allowedCurrencies(): array
    {
        return array_keys($this->getRates());
    }
}
