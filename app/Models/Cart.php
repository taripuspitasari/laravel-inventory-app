<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_quantity', 'total_amount', 'is_checked_out'];

    public function cartDetails()
    {
        return $this->hasMany(Cart_detail::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
