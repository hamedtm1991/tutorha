<?php

use Carbon\Carbon;
use Illuminate\Http\Response as status;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use App\Models\Episode;
use App\Models\Product;

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

function getVideoUrl(array $data)
{
    if ($data) {
        $response = Http::asForm()->post(env('DL_SERVER_ADDRESS') . '/api/url/video', [
            'secret' => bcrypt(md5(env('VIDEO_SIGN_SECRET_KEY'))),
            'ip' => \Illuminate\Support\Facades\Request::ip(),
            'data' => $data,
        ]);

        if ($response->status() === status::HTTP_OK) {
            return $response->getBody()->getContents();
        }
    }

    return '';
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
