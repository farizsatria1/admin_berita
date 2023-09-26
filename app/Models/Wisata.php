<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    public $table = "wisatas";
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_wisata',
        'image',
        'alamat',
        'url_map',
        'ket_wisata',
    ];
}
