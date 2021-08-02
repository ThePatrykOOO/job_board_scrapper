<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class JobOfferResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'reference_number' => $this->reference_number,
            'short_description' => $this->short_description,
            'long_description' => $this->long_description,
            'link_to_application' => $this->link_to_application,
        ];
    }
}
