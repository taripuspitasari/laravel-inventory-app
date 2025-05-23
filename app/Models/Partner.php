<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Partner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        });

        $query->when($filters['filter'] ?? false, function ($query, $filter) {
            return $query->where('partner_type', $filter);
        });
    }

    public function scopeSupplier($query)
    {
        return $query->where('partner_type', 'supplier');
    }

    public function scopeCustomer($query)
    {
        return $query->where('partner_type', 'customer');
    }

    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class, "partner_id", "id");
    }
}
