<?php

namespace JWorksUK\Mondo;

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
    public static function formatMoney($units, $locale = 'en_GB')
    {
        $units = $units / 100;

        setlocale(LC_MONETARY, $locale);

        return money_format('%n', $units);
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
