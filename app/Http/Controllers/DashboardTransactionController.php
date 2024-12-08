<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Transaction_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $statusColors = [
            'done' => 'bg-green-500',
            'inprogress' => 'bg-yellow-500',
            'cancelled' => 'bg-red-500',
        ];

        return view('dashboard.transactions.index', [
            "title" => "Transactions",
            "transactions" => Transaction::filter(request(['search', 'filter']))->with('partner')->simplePaginate(7)->withQueryString(),
            "statusColors" => $statusColors
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->input('type');

        $data = [
            "title" => $type === "purchase" ? "Create new purchase" : "Create new sale",
            "type" => $type,
            "partner" => $type === "purchase" ? "Supplier" : "Customer",
            "button" => $type === "purchase" ? "Create Purchase" : "Create Sale",
            "categories" => Category::all(),
            "products" => Product::all(),
            "partners" => $type === "purchase" ? Partner::supplier()->get() : Partner::customer()->get()
        ];

        return view('dashboard.transactions.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'transaction_type' => ['required', 'in:in,out'],
            'date' => ['required', 'date'],
            'partner_id' => ['required', 'exists:partners,id'],
            'notes' => ['nullable'],
            'items' => ['required', 'array'],
            'items.*.item_id' => ['required', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1'],
            'items.*.price' => ['required', 'numeric', 'min:0.01']
        ]);

        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'transaction_type' => $validatedData['transaction_type'],
                'created_at' => $validatedData['date'],
                'partner_id' => $validatedData['partner_id'],
                'notes' => $validatedData['notes'],
                'user_id' => Auth::user()->id,
                'totalAmount' => 0,
                'invoice_number' => $request['invoice_number'],
                'tax' => 0
            ]);

            $totalAmount = 0;

            foreach ($validatedData['items'] as $item) {
                $totalAmount += $item['quantity'] * $item['price'];

                Transaction_detail::create([
                    'quantity' => $item['quantity'],
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['item_id'],
                    'price' => $item['price']
                ]);

                $currentItem = Product::find($item['item_id']);
                if ($validatedData['transaction_type'] == 'in') {
                    $currentItem->stock += $item['quantity'];
                } else {
                    $currentItem->stock -= $item['quantity'];
                }
                $currentItem->save();
            }

            $tax = $totalAmount * 0.11;

            $transaction->tax = $tax;
            $transaction->totalAmount = $totalAmount + $tax;
            $transaction->save();

            DB::commit();
            return redirect('dashboard/transactions')->with('success', 'The transaction has been added!');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect('dashboard/transactions')->with('error', 'The transaction is failed!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $statusColors = [
            'done' => 'text-green-500',
            'inprogress' => 'text-yellow-500',
            'cancelled' => 'text-red-500',
        ];

        $subtotal = $transaction->transactionDetails->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });
        $tax = $subtotal * 0.11;
        $total = $subtotal + $tax;
        return view('dashboard.transactions.show', [
            "title" => "Transactions Details",
            "transaction" => $transaction->load('transactionDetails.product'),
            "subtotal" => $subtotal,
            "tax" => $tax,
            "total" => $total,
            "statusColors" => $statusColors
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
