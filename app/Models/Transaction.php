<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('invoice_number', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['filter'] ?? false, function ($query, $filter) {
            return $query->where('transaction_type', $filter);
        });
    }

    public function transactionDetails(): HasMany
    {
        return $this->hasMany(TransactionDetail::class, "transaction_id", "id");
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_details')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function partner(): BelongsTo
    {
        return $this->belongsTo(Partner::class, "partner_id", "id");
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id", "id");
    }
}
