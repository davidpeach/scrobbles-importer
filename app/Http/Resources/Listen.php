<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Log;

class Listen extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        Log::info($this->song->album->artist->name);
        return [
            'title' => $this->song->title,
            'album' => $this->song->album->title,
            'artist' => $this->song->album->artist->name,
            'date' => $this->listened_at->format('Y-m-d H:i:s'),
            'image' => $this->song->album->preferredImage(),
        ];
    }
}
