<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Services\SupplierService;
use Illuminate\Http\Request;

class DashboardSupplierController extends Controller
{
    private $supplierService;

    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.suppliers.index', [
            'title' => 'Suppliers',
            'suppliers' => $this->supplierService->getAllSuppliers(request(['search']))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.suppliers.create', [
            'title' => 'Create New Supplier'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns', 'unique:suppliers'],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'address' => ['required', 'min:7', 'max:255']
        ]);

        $this->supplierService->createSupplier($validatedData);
        return redirect('dashboard/suppliers')->with('success', 'New supplier has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('dashboard.suppliers.show', [
            'supplier' => $supplier,
            'title' => 'Supplier Information',
            'purchases' => $supplier->purchases()->latest()->simplePaginate(5)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('dashboard.suppliers.edit', [
            'title' => 'Edit Supplier',
            'supplier' => $supplier
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $rules = ([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email:dns'],
            'phone' => ['required', 'regex:/^[0-9]{10,15}$/'],
            'address' => ['required', 'min:7', 'max:255']
        ]);

        if ($request->email != $supplier->email) {
            $rules['email'] = ['required', 'email', 'max:255', 'unique:suppliers'];
        }

        $validatedData = $request->validate($rules);

        $this->supplierService->updateSupplier($supplier, $validatedData);

        return redirect('/dashboard/suppliers')->with('success', 'Supplier has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $this->supplierService->deleteSupplier($supplier);
        return redirect('/dashboard/suppliers')->with('success', 'Supplier has been deleted!');
    }
}
