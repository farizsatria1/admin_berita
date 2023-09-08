<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BeritaDetailresource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "title" => $this->title,
            "author" => $this->author,
            "kategori_id" => $this->kategori_id,
            "image" => Storage::url($this->image),
            "content" => $this->content,
            "created_at" => date_format($this->created_at,"l, Y-m-d H:i:s"),
            "kategori" => $this->whenLoaded('kategori')
        ];
    }
}
