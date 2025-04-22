<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'support_phone',
        'logo',
        'favicon',
        'site_name',
        'site_description',
        'site_keywords',
        'site_author',
        'address',
        'payment_policy',
        'warranty_policy',
        'privacy_policy',
        'download_limit',
        'timeframe_hours',
    ];

    protected $table = 'website_settings';

    public function logoImage()
    {
        return $this->belongsTo(Media::class, 'logo');
    }

    public function faviconImage()
    {
        return $this->belongsTo(Media::class, 'favicon');
    }
}
