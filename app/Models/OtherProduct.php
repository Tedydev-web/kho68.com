<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OtherProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'category_id',
        'thumbnail',
        'gallery',
        'type',
        'description',
        'demo_link',
        'download_link',
        'price',
        'stock',
        'sold_quantity',
        'system_requirements',
        'status',
'additional_data',
    ];
    protected $casts = [
        'gallery' => 'array', // Cast JSON to array
        'price' => 'decimal:2', // Cast price to decimal with 2 decimal points
    ];
      // Thêm quan hệ với bảng Category
      public function category()
      {
          return $this->belongsTo(Category::class, 'category_id');
      }
      public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
