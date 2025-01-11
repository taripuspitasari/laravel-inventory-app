<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;
use App\Services\PartnerService;

class DashboardPartnerController extends Controller
{
    protected $partnerService;

    public function __construct(PartnerService $partnerService)
    {
        $this->partnerService = $partnerService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.partners.index', [
            'title' => 'Partners',
            'partners' => $this->partnerService->getAllPartners(request(['search', 'filter']))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.partners.create', [
            'title' => 'Create New Partner'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:partners'],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'partner_type' => ['required'],
            'address' => ['required', 'min:7', 'max:255']
        ]);

        $this->partnerService->createPartner($validatedData);
        return redirect('dashboard/partners')->with('success', 'New partner has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Partner $partner)
    {
        return view('dashboard.partners.show', [
            'partner' => $partner,
            'title' => 'Partner Detail',
            'transactions' => $partner->transactions()->paginate(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Partner $partner)
    {
        return view('dashboard.partners.edit', [
            'title' => 'Edit Partner',
            'partner' => $partner
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Partner $partner)
    {
        $rules = ([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns'],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'partner_type' => ['required'],
            'address' => ['required', 'min:7', 'max:255']
        ]);

        if ($request->email != $partner->email) {
            $rules['email'] = ['required', 'email', 'max:255', 'unique:partners'];
        }

        $validatedData = $request->validate($rules);

        $this->partnerService->updatePartner($partner, $validatedData);

        return redirect('/dashboard/partners')->with('success', 'Partner has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Partner $partner)
    {
        $this->partnerService->deletePartner($partner);
        return redirect('/dashboard/partners')->with('success', 'Partner has been deleted!');
    }
}
