<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class WisataResource extends JsonResource
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
            "nama_wisata" => $this->nama_wisata,
            "alamat" => $this->alamat,
            "url_map" => $this->url_map,
            "image" => "http://192.168.37.146/storage/" . $this->image,
            "ket_wisata" => $this->ket_wisata,
            "created_at" => date_format($this->created_at, "l, Y-m-d H:i:s"),
        ];
    }
}
