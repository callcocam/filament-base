<?php

/**
 * Created by Claudio Campos.
 * User: callcocam@gmail.com, contato@sigasmart.com.br
 * https://www.sigasmart.com.br
 */

namespace App\Core\Helpers;

use Carbon\Carbon; 
use NumberFormatter;

class Helper
{

    public static function translatedFormatShort($date): string
    {
        return  Carbon::parse($date)->translatedFormat('d M Y');
    }

    public static function translatedFormatShortTime($date): string
    {
        return  Carbon::parse($date)->translatedFormat('d M Y H:i');
    }

    public static function translatedFormatShortTimeAgo($date): string
    {
        return  Carbon::parse($date)->translatedFormat('d M Y H:i') . ' (' . Carbon::parse($date)->diffForHumans() . ')';
    }

    public static function translatedFormatShortDay($date): string
    {
        return  Carbon::parse($date)->translatedFormat('l');
    }
  

    public static function toFloat($value)
    {
        if (is_null($value)) {
            return 0.00;
        }

        $source = array('.', ',');
        $replace = array('', '.');
        $valor = str_replace($source, $replace, $value); //remove os pontos e substitui a virgula pelo ponto
        return $valor; //retorna o valor formatado para gravar no banco
    }

    public static function toReal($value)
    {
        if (is_null($value)) {
            return '0,00';
        }
        return number_format($value, 2, ',', '.');
    }

    public static function toPercent($value)
    {
        if (is_null($value)) {
            return '0,00%';
        }
        return number_format($value, 2, ',', '.') . '%';
    }

    public static function toPayout($odd, $model, $total, $type = 'draw')
    {
        $total = self::toFloat($total);
        $odd = self::toFloat($odd);
        $model = self::toFloat($model);
        $payout = self::toFloat(self::Calcular($total, $odd, $type));
        $profit = self::toFloat(self::Calcular($payout, $model, '-'));
        return [
            'payout' => self::toReal($payout),
            'profit' => self::toReal($profit)
        ];
    }

    /**
     * @param $v1
     * @param $v2
     * @param $op
     * @return float|int
     */
    public static function Calcular($v1, $v2, $op, $format = true)
    {
        $v1 = str_replace(".", "", $v1);
        $v1 = str_replace(",", ".", $v1);
        $v2 = str_replace(".", "", $v2);
        $v2 = str_replace(",", ".", $v2);
        switch ($op) {
            case "+":
                $r = $v1 + $v2;
                break;
            case "-":
                $r = $v1 - $v2;
                break;
            case "*":
                $r = $v1 * $v2;
                break;
            case "%":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $v1 + $j;
                break;
            case "/":
                @$r = @$v1 / $v2;
                break;
            case "tj":
                $bs = $v1 / 100;
                $j = $v2 * $bs;
                $r = $j;
                break;
            default:
                $r = $v1;
                break;
        }
        if ($format)
            return @number_format($r, 2, ",", ".");
        else
            return $r;
    }

    public static function money($money, string $currency = 'BRL', int $divideBy = 0)
    {
        $formatter = new NumberFormatter(app()->getLocale(), NumberFormatter::CURRENCY);

        if ($divideBy) {
            $money /= $divideBy;
        }

        return $formatter->formatCurrency($money, $currency);
    }

}
