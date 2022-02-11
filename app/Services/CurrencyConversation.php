<?php

namespace App\Services;

use App\Models\Currency;
use Carbon\Carbon;

class CurrencyConversation
{
    const DEFAULT_CURRENCY_CODE = 'RUB';
    protected static $container;

    public static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency){
                self::$container[$currency->code] = $currency;
            }
        }
    }

    public static function getCurrencies()
    {
        return self::$container;
    }

    public static function getCurrencyFromSession()
    {
        return session('currency', self::DEFAULT_CURRENCY_CODE);
    }

    public static function getCurrentCurrencyFromSession()
    {
        self::loadContainer();
        $currencyCode = self::getCurrencyFromSession();

        foreach (self::$container as $currency){
            if ($currency->code === $currencyCode) {
                return $currency;
            }
        }
    }

    public static function convert($sum, $originCurrencyCode = self::DEFAULT_CURRENCY_CODE, $targetCurrencyCode = null)
    {
        self::loadContainer();

        $originCurrency = self::$container[$originCurrencyCode];

        if (is_null($targetCurrencyCode)) {
            $targetCurrencyCode = self::getCurrencyFromSession();
        }
        $targetCurrency = self::$container[$targetCurrencyCode];

        if ($originCurrency->code != self::DEFAULT_CURRENCY_CODE) {
            if ($originCurrency->rate != 0 || $originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $originCurrency = self::$container[$originCurrencyCode];
            }

            if ($originCurrency->rate == 0 || $targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay()) {
                CurrencyRates::getRates();
                self::loadContainer();
                $targetCurrency = self::$container[$targetCurrencyCode];
            }
        }




        return $sum / $originCurrency->rate * $targetCurrency->rate;
    }

    public static function getCurrencySymbol()
    {
        self::loadContainer();
        return self::$container[self::getCurrencyFromSession()]->symbol;
    }

    public static function getBaseCurrency()
    {
        self::loadContainer();

        foreach (Self::$container as $code => $currency){
            if ($currency->isMain()) {
                return $currency;
            }
        }
    }
}
