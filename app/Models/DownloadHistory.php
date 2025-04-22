<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadHistory extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'file_id',
        'downloaded_at',
        'ip_address',
    ];

    /**
     * Get the user that owns the download history.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Optionally, you can create a method to get the file details if needed.
     * This assumes you have a File model that corresponds to the downloaded file.
     */
   
}
