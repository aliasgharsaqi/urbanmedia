<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    public function toArray($request)
    {
        return array_merge(
            $this->resource->toArray(), // all attributes from Event

            [
                    'user' => $this->whenLoaded('user', function () {
                    return $this->user->toArray(); // raw user array
                }),
                'categories' => $this->whenLoaded('categories', function () {
                    return $this->categories->toArray(); // raw categories array
                }),
            ]
        );
    }
}
