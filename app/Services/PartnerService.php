<?php

namespace App\Services;

use App\Models\Partner;

class PartnerService
{
    public function getAllPartners($filters)
    {
        return Partner::filter($filters)->simplePaginate(7)->withQueryString();
    }

    public function createPartner($data)
    {
        return Partner::create($data);
    }

    public function updatePartner($partner, $data)
    {
        return $partner->update($data);
    }

    public function deletePartner($partner)
    {
        return $partner->delete();
    }
}
