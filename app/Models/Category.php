<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'title', 'site_id'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function site()
    {
        return $this->belongsTo(Site::class, 'site_id');
    }
}
