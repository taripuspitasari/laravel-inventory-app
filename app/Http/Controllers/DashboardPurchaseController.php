<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Services\PurchaseService;

class DashboardPurchaseController extends Controller
{
    private $purchaseService;

    public function __construct(PurchaseService $purchaseService)
    {
        $this->purchaseService = $purchaseService;
    }

    public function index()
    {
        return view('dashboard.purchases.index', [
            "title" => "Purchases",
            "purchases" => $this->purchaseService->getAllPurchases(request(['search']))
        ]);
    }

    public function create()
    {
        return view('dashboard.purchases.create', [
            "title" =>  "Create new purchase",
            "categories" => Category::all(),
            "products" => Product::all(),
            "suppliers" => Supplier::all()
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'date' => ['required', 'date'],
            'supplier_id' => ['required', 'exists:suppliers,id'],
            'notes' => ['nullable'],
            'invoice_number' => ['required'],
            'items' => ['required', 'array'],
            'items.*.item_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0.01']
        ]);

        // $response = $this->purchaseService->createPurchase($validatedData, $request['invoice_number']);

        $response = $this->purchaseService->createPurchase($validatedData);

        if ($response['success']) {
            return redirect('dashboard/purchases')->with('success', $response['message']);
        }

        return redirect('dashboard/purchases')->with('error', $response['message']);
    }

    public function show(Purchase $purchase)
    {
        $subtotal = $purchase->total_amount - $purchase->tax;

        return view('dashboard.purchases.show', [
            'title' => 'Purchase Details',
            'purchase' => $purchase,
            'subtotal' => $subtotal
        ]);
    }
}
