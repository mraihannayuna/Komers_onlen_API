<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KomersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'image' => $this->image,
            'product' => $this->product,
            'price' => $this->price,
            'description' => $this->description,
            'seller' => $this->seller['name'],
            'created_at' => date_format($this->created_at, "Y/m/d H:i:s"),
        ];
    }
}
