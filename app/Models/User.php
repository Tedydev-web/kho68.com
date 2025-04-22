<?php

namespace App\Models;

use BezhanSalleh\FilamentShield\Traits\HasPanelShield;
use Illuminate\Contracts\Auth\MustVerifyEmail as MustVerifyEmailContract;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable , HasRoles , HasPanelShield ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function userDetail()
    {
        return $this->hasOne(UserDetail::class);
    }
    public function carts()
{
    return $this->hasMany(Cart::class); // Quan hệ 1-n: một người dùng có nhiều giỏ hàng
}
public function cart()
{
    return $this->hasOne(Cart::class); // Quan hệ 1-1: một người dùng có một giỏ hàng
}
public function wishlist()
{
    return $this->hasMany(Wishlist::class);
}
public function wallet()
{
    return $this->hasOne(Wallet::class);
}

// Quan hệ với bảng transactions
public function transactions()
{
    return $this->hasMany(Transaction::class);
}
public function download_history()
{
    return $this->hasMany(DownloadHistory::class);
}

}
