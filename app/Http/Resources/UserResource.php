<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'user_id' => $this->user_id,
            // 'name' => $this->name,
            'email' => $this->email,
            'roles' => $this->roles,
            'created_at' => $this->created_at->format('d M Y h:i A'),
        ];
    }
}
