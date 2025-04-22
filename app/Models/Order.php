<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'status',
        'payment_method',
        'payment_date',
        'total_after_discount',
        'discount_type',
        'discount_amount',
        'discount_code',
    ];

    // Quan hệ 1-n với bảng order_items
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Quan hệ n-1 với bảng users
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Tính tổng số lượng sản phẩm trong đơn hàng
    public function getTotalQuantityAttribute()
    {
        return $this->items->sum('quantity');
    }
}
