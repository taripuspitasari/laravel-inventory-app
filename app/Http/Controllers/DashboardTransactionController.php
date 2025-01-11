<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Services\TransactionService;

class DashboardTransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.transactions.index', [
            "title" => "Transactions",
            "transactions" => $this->transactionService->getTransactions(request(['search', 'filter']))
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $this->transactionService->prepareCreateData($request->input('type'));
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

        $response = $this->transactionService->createTransaction($validatedData, $request['invoice_number']);

        if ($response['success']) {
            return redirect('dashboard/transactions')->with('success', $response['message']);
        }

        return redirect('dashboard/transactions')->with('error', $response['message']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        $data = $this->transactionService->showTransactionDetails($transaction);
        return view(
            'dashboard.transactions.show',
            array_merge(["title" => "Transactions Details"], $data)
        );
    }
}
