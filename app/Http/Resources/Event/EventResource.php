<?php

namespace App\Http\Resources\Event;

use App\Http\Resources\User\UserIndexResource;
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
        $createdAt = null;
        if ($this->created_at) {
            $createdAt = (new \DateTime($this->created_at))->format('d.m.Y');
        }
        return [
            'id' => $this->id,
            'header' => $this->header,
            'text' => $this->text,
            'created_at' => $createdAt,
            'participants' => UserIndexResource::collection($this->participants),
            'creator' => new UserIndexResource($this->creator),
        ];
    }
}
