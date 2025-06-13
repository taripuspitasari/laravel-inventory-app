<?php

namespace App\Services;

use App\Models\Supplier;

class SupplierService
{
    public function getAllSuppliers($filters)
    {
        return Supplier::filter($filters)->simplePaginate(7)->withQueryString();
    }

    public function createSupplier($data)
    {
        return Supplier::create($data);
    }

    public function updateSupplier($supplier, $data)
    {
        return $supplier->update($data);
    }

    public function deleteSupplier($supplier)
    {
        return $supplier->delete();
    }
}
