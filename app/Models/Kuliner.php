<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuliner extends Model
{
    use HasFactory;
    public $table = "kuliners";
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama_kuliner',
        'image',
        'alamat',
        'url_map',
        'ket_kuliner',
    ];
}
