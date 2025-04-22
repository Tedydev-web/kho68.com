<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialAccountProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'social_product_id',
        'attribute_name',
        'account_data',
        'status',
        'quantity',
        'additional_price'
    ];

    public function socialProduct()
    {
        return $this->belongsTo(SocialAccountProduct::class, 'social_product_id');
    }
}
