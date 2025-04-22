<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class CartItem extends Model
    {
        use HasFactory;

        protected $fillable = [
            'cart_id',
            'wordpress_product_id',
            'attribute_id',
            'course_product_id',
            'social_account_product_id',
            'other_product_id',
            'quantity',
            'price',
            'type',
        ];

        // Thiết lập mối quan hệ nhiều-một với Cart
        public function cart()
        {
            return $this->belongsTo(Cart::class);
        }

        public function product()
        {
            switch ($this->type) {
                case 'wordpress':
                    return $this->belongsTo(WordpressProduct::class, 'wordpress_product_id');
                case 'course':
                    return $this->belongsTo(Course::class, 'course_product_id');
                case 'social':
                    return $this->belongsTo(SocialAccountProduct::class, 'social_account_product_id');
                case 'other':
                    return $this->belongsTo(OtherProduct::class, 'other_product_id');
            }
        }



        public function course()
        {
            return $this->belongsTo(Course::class, 'course_product_id');
        }
    }
