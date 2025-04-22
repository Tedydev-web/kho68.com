<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'long_description',
        'price',
        'sale_price',
        'image',
        'instructor',
        'duration',
        'level',
        'video_count',
        'download_link',
        'video_url',
        'views',
        'status'
    ];

    public function modules()
    {
        return $this->hasMany(CourseModule::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    } public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
