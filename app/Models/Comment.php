<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    public $table = "comments";
    protected $fillable = [
        'name',
        'email',
        'comment',
        'berita_id'
    ];

    public function berita(): BelongsTo
    {
        return $this->belongsTo(Berita::class, 'berita_id','id');
    }
}
