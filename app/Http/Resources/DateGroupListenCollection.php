<?php

namespace App\Http\Resources;

use App\Http\Resources\Listen;
use Illuminate\Http\Resources\Json\ResourceCollection;

class DateGroupListenCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $data = [];

        foreach ($this->collection as $listen) {
            list($year, $month, $day) = explode(' ', $listen->listened_at->format('Y m d'));

            if (!array_key_exists($year . '_' . $month . '_' . $day, $data)) {
                $data[$year . '_' . $month . '_' . $day] = collect();
            }

            $data[$year . '_' . $month . '_' . $day]->push(new Listen($listen));
        }

        return [
            'data' => $data,
            'latest_scrobble_date' => $this->collection->pop()->listened_at->toDateTimeString(),
        ];
    }
}
