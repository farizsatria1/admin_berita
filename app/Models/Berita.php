<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Berita extends Model
{
    use HasFactory;
    public $table = "beritas";
    protected $fillable = [
        'title',
        'author',
        'kategori_id',
        'content',
        'image',
        'created_at',
        'comments'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'berita_id');
    }
}
 
