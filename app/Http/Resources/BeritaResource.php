<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BeritaResource extends JsonResource
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
            "image" => Storage::url($this->image),
            "created_at" => date_format($this->created_at, "Y-m-d H:i:s"),
            "kategori_id" => $this->kategori_id,
            "nama_kategori" => optional($this->kategori)->nama_kategori,
            "image_kategori" => Storage::url($this->kategori->image_kategori)
        ];
    }
}
