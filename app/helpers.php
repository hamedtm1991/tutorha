<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

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
        return jdate(Carbon::parse($date)->setTimezone('asia/tehran'))->format($format);
    }
}

/**
 * @param array $data
 * @return array
 */
function getVideoUrl(array $data): array
{
    $links = [];
    if ($data) {
        foreach ($data as $key => $link) {
            $explode = explode('-', $link);
            $name = $explode[0] ?? '';
            $numberOfEpisode = $explode[1] ?? 0;
            $links[$key] = URL::temporarySignedRoute(
                'video', now()->addMinutes(60),
                ['playlist' => $name . '.m3u8', 'episode' => $numberOfEpisode, 'ip' => Request::ip()]
            );
        }

        return $links;
    }

    return [];
}

/**
 * @param $string
 * @return string
 */
function convertPersianNumbersToEnglish($string): string
{
    $persian = ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'];
    $arabic = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    $num = range(0, 9);
    $convertedPersianNums = str_replace($persian, $num, $string);
    $englishNumbersOnly = str_replace($arabic, $num, $convertedPersianNums);

    return $englishNumbersOnly;
}
