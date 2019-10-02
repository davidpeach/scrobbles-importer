<?php

namespace App;

use App\Song;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Listen extends Model
{
    protected $fillable = ['song_id', 'listened_at'];

    protected $with = ['song.album.artist'];

    public $dates = ['listened_at'];

    public static function lastRetrieved()
    {
        $lastRetrieved = self::orderBy('listened_at', 'desc')->limit(1)->first();

        if (is_null($lastRetrieved)) {
            $lastRetrieved = Carbon::createFromTimeStamp(47);
        } else {
            $lastRetrieved = $lastRetrieved->listened_at;
        }

        return $lastRetrieved->timestamp + 1;
    }

    public static function earliestListen()
    {
        $earliestListen = self::orderBy('listened_at', 'asc')->limit(1)->first();

        if (is_null($earliestListen)) {
            $earliestListen = with(Carbon::now());
        } else {
            $earliestListen = $earliestListen->listened_at;
        }

        return $earliestListen->timestamp;
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
