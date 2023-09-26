<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{
    use HasFactory;
    public $table = "galerys";
    protected $primaryKey = 'id';
    protected $fillable = [
        'image_galery',
    ];
}
