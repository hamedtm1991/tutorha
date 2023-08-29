<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\App;

/**
 * @param $date
 * @param null $enFormat
 * @param null $faFormat
 * @return string
 * in this function we set date by lang
 */
function localDate($date, $enFormat = null, $faFormat = null): string
{
    if (empty($date)) {
        return '-';
    }
    if (App::isLocale('en')) {
        $format = is_null($enFormat) ? 'M d Y D' : $enFormat;
        return Carbon::parse($date)->format($format);
    } else {
        $format = is_null($faFormat) ? '%A، %d %B %Y' : $faFormat;

        return jdate($date)->format($format);
    }
}
