<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'disk', 'directory', 'visibility', 'name', 'path',
        'width', 'height', 'size', 'type', 'ext',
        'alt', 'title', 'description', 'caption', 'exif', 'curations'
    ];
}
