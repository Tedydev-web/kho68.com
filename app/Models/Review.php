<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment',
        'rating',
        'user_id',
    ];

    // Define the polymorphic relationship
    public function reviewable()
    {
        return $this->morphTo();
    }

    // Relationship with the user (the reviewer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
