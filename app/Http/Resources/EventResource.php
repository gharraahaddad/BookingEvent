<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
          return [
        'id' => $this->id,
        'title' => $this->title,
        'description' => $this->description,
        'date' => $this->date,
        'capacity' => $this->capacity,
        'image' => $this->image,
        'created_by' => new UserResource($this->whenLoaded('user')),
    ];
    }
}
