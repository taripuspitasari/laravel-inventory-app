<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function transactionDetails()
    {
        return $this->hasMany(TransactionDetail::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_details')
            ->withPivot('quantity', 'price')
            ->withTimestamps();
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
