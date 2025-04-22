<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'image', 'link', 'status'];

    public function media()
    {
        return $this->belongsTo(Media::class, 'image', 'id');
    }
}
