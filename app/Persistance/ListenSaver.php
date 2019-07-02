<?php

namespace App\Persistance;

use App\Album;
use App\Artist;
use App\Listen;
use App\Song;
use Carbon\Carbon;

class ListenSaver
{
    /**
     * Save the listens to the database.
     * Also ensuring the Artist, Album and Song relationships are present
     *
     * @param array $listens
     * @return void
     */
    public function save(array $listens)
    {

        foreach ($listens as $listen) {

            // Make sure artist exists
            $artistId = $this->retrieveArtistId($listen);
            // Make sure album exists
            $albumId = $this->retrieveAlbumId($listen, $artistId);
            // Make sure song exists
            $songId = $this->retrieveSongId($listen, $albumId);
            // Then Save the listen.
            Listen::create([
                'song_id' => $songId,
                'listened_at' => Carbon::createFromTimestamp($listen['listen_timestamp'])
                ]);

        }

    }


    protected function retrieveArtistId($listen)
    {
        $artist = Artist::whereName($listen['artist_name'])->first();

        if (is_null($artist)) {
            $artist = Artist::create([
                'name' => $listen['artist_name']
                ]);
        }

        return $artist->id;
    }


    protected function retrieveAlbumId($listen, $parentId)
    {
        $album = Album::whereTitle($listen['album_title'])->whereArtistId($parentId)->first();

        if (is_null($album)) {
            $album = Album::create([
                'artist_id' => $parentId,
                'title' => $listen['album_title'],
                'images' => $listen['album_images']
                ]);
        }

        return $album->id;
    }


    protected function retrieveSongId($listen, $parentId)
    {
        $song = Song::whereTitle($listen['song_title'])->whereAlbumId($parentId)->first();

        if (is_null($song)) {
            $song = Song::create([
                'album_id' => $parentId,
                'title' => $listen['song_title']
                ]);
        }

        return $song->id;
    }
}