<?php

use Carbon\Carbon;
use Illuminate\Http\Response as status;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;
use App\Models\Episode;

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

function getVideoUrl(string $link, Episode $episode)
{
    if (empty($episode->price) || $episode->checkOrder()) {
        $explode = explode('-', $link);
        $name = $explode[0] ?? '';
        $numberOfEpisode = $explode[1] ?? 0;
        $response = Http::asForm()->post('http://192.168.1.5:8000/api/url/video', [
            'secret' => bcrypt(md5(env('VIDEO_SIGN_SECRET_KEY'))),
            'name' => $name,
            'episode' => $numberOfEpisode,
        ]);

        if ($response->status() === status::HTTP_OK) {
            return $response->getBody()->getContents();
        }
    }

    return '';
}
