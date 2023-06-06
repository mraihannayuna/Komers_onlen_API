<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewsResource extends JsonResource
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
            'review_content' => $this->review_content,
            'reviewer' => $this->reviewer['name'],
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
        ];
    }
}
