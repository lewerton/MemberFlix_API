<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    use HasFactory;

    // Permitir atribuição em massa e usar id customizado
    protected $fillable = ['id', 'title', 'domain'];
    public $incrementing = false;
    protected $keyType = 'string';

    public function categories()
    {
        return $this->hasMany(Category::class, 'site_id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'site_id');
    }
}
