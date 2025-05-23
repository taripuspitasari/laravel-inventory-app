<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('id', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['filter'] ?? false, function ($query, $filter) {
            return $query->where('order_status', $filter);
        });
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class, "order_id", "id");
    }


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function address(): BelongsTo
    {
        return $this->belongsTo(Address::class, "address_id", "id");
    }
}
