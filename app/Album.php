<?php

namespace App;

use App\Artist;
use App\Song;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $fillable = ['artist_id', 'title', 'images', 'release_date'];

    protected $with = ['artist'];

    public function artist()
    {
        return $this->belongsTo(Artist::class);
    }

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function preferredImage()
    {
        $images = unserialize($this->images);
        $imgUrl = '';

        if (!$images) {
            return $imgUrl;
        }

        foreach ($images as $image) {

            $textProperty = '#text';

            if (empty($image->$textProperty)) {
                continue;
            }

            $imgUrl = $image->$textProperty;
        }

        if (empty($imgUrl)) {
            return 'https://www.placecage.com/400/400';
        }

        return $imgUrl;
    }

}
