<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id', 'title', 'created_at', 'category', 'hls_path',
        'description', 'thumbnail', 'site_id', 'views', 'likes'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category');
    }
}
