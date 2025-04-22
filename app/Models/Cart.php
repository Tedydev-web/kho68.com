<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total'];

    // Thiết lập mối quan hệ một-nhiều với CartItem
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    // Thiết lập mối quan hệ nhiều-nhiều với User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
