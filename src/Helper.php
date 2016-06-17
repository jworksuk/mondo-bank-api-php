<?php

namespace JWorksUK\Mondo;

use Symfony\Component\Intl\Intl;

class Helper
{
    const MONDO_DATETIME = 'Y-m-d\TH:i:s.uP';

    const APP_DATETIME = 'Y-m-d H:i:s';

    /**
     * Formats money
     *
     * @param int    $units  64bit integer in minor units of the currency
     * @param string $locale
     *
     * @return string
     */
    public static function formatMoney($units, $currency)
    {
        \Locale::setDefault('en');

        // Get Currency Symbol
        $symbol = Intl::getCurrencyBundle()->getCurrencySymbol($currency);

        // Decimal places
        $decimals = Intl::getCurrencyBundle()->getFractionDigits($currency);

        $units = $units / 100;

        return trim($symbol . ' ' . number_format($units, $decimals));
    }

    /**
     * Creates DateTime class
     *
     * @param string $format
     * @param string $time
     *
     * @return DateTime
     */
    public static function createDateTime($format, $time)
    {
        return \DateTime::createFromFormat($format, $time);
    }
}
