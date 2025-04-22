<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;

    class Category extends Model
    {
        use HasFactory;

        protected $fillable = ['name', 'slug', 'parent_id', 'status'];

        // Quan hệ một-nhiều (cha-con) với chính bảng `categories`
        public function children()
        {
            return $this->hasMany(Category::class, 'parent_id');
        }

        // Quan hệ với danh mục cha
        public function parent()
        {
            return $this->belongsTo(Category::class, 'parent_id');
        }

        // Quan hệ với sản phẩm
        public function products()
        {
            return $this->hasMany(Product::class);
        }

        public function socialAccountProducts()
        {
            return $this->hasMany(SocialAccountProduct::class,  'category_id');
        }

        // Quan hệ với Course (khóa học)
        public function courses()
        {
            return $this->hasMany(Course::class, 'category_id');
        }

        // Quan hệ với OtherProduct (các sản phẩm khác)
        public function otherProducts()
        {
            return $this->hasMany(OtherProduct::class, 'category_id');
        }

        // Quan hệ với WordpressProduct (sản phẩm Wordpress)
        public function wordpressProducts()
        {
            return $this->hasMany(WordpressProduct::class, 'category_id');
        }
    }
