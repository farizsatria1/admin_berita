<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class KulinerResource extends JsonResource
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
            "nama_kuliner" => $this->nama_kuliner,
            "alamat" => $this->alamat,
            "url_map" => $this->url_map,
            "image" => "http://192.168.37.146/storage/" . $this->image,
            "ket_kuliner" => $this->ket_kuliner,
            "created_at" => date_format($this->created_at,"l, Y-m-d H:i:s"),
        ];
    }
}
