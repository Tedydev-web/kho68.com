<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class WordpressProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id', 'name', 'slug', 'image', 'gallery', 'sku', 'type', 'status',
        'version', 'short_content', 'long_content', 'price', 'sale_price', 'sold',
        'demo', 'download_link', 'system_requirements', 'license_key', 'license_expiration_date', 'views',
    ];

    protected $casts = [
        'gallery' => 'array',
    ];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
