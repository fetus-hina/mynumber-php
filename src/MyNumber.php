<?php
/**
 * @author AIZAWA Hina <hina@bouhime.com>
 * @copyright 2015 AIZAWA Hina <hina@bouhime.com>
 * @license https://github.com/fetus-hina/mynumber-php/blob/master/LICENSE MIT
 */

namespace jp3cki\mynumber;

class MyNumber
{
    public static function isValid($number)
    {
        if (!preg_match('/^[0-9]{12}$/', $number)) {
            return false;
        }

        return static::calcCheckDigit(substr($number, 0, 11)) === $number[11];
    }

    public static function calcCheckDigit($number)
    {
        $number = substr($number, 0, 11);
        if (!preg_match('/^[0-9]{11}$/', $number)) {
            return false;
        }

        $sum = 0;
        for ($i = 0; $i < 11; ++$i) {
            $pn = $number[10 - $i];
            $qn = $i < 6 ? $i + 2 : $i - 4;
            $sum += $pn * $qn;
        }

        $cd = 11 - $sum % 11;
        return $cd > 9 ? '0' : (string)$cd;
    }

    public static function generate()
    {
        $number = sprintf('%06d%05d', random_int(0, 999999), random_int(0, 99999));
        $number .= static::calcCheckDigit($number);
        return $number;
    }
}
