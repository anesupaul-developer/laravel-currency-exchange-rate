<?php

namespace App\Exceptions;

use Exception;

class CurrencyConversionException extends Exception
{
    //
    const RATES_FAILED_EXCEPTION = 'Failed to fetch current rates. Please try again later!';
}
