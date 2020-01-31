<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'name' => $this->name,
            'total_members' => $this->members->count(),
            'slug' => $this->slug,
            'owner' => new UserResource($this->owner),
            'member' => UserResource::collection($this->members)
        ];
    }
}
