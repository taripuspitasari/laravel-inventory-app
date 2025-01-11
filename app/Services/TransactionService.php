<?php

namespace App\Services;

use App\Models\Partner;
use App\Models\Product;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionService
{
    public function getTransactions($filters)
    {
        return Transaction::filter($filters)->with('partner')->simplePaginate(7)->withQueryString();
    }

    public function prepareCreateData($type)
    {
        return [
            "title" => $type === "purchase" ? "Create new purchase" : "Create new sale",
            "type" => $type,
            "partner" => $type === "purchase" ? "Supplier" : "Customer",
            "button" => $type === "purchase" ? "Create Purchase" : "Create Sale",
            "categories" => Category::all(),
            "products" => Product::all(),
            "partners" => $type === "purchase" ? Partner::supplier()->get() : Partner::customer()->get()
        ];
    }

    public function createTransaction($data, $invoiceNumber)
    {
        DB::beginTransaction();

        try {
            $transaction = Transaction::create([
                'transaction_type' => $data['transaction_type'],
                'created_at' => $data['date'],
                'partner_id' => $data['partner_id'],
                'notes' => $data['notes'],
                'user_id' => Auth::user()->id,
                'total_amount' => 0,
                'invoice_number' => $invoiceNumber,
                'tax' => 0
            ]);

            $total_amount = 0;

            foreach ($data['items'] as $item) {
                $item['subtotal'] = $item['price'] * $item['quantity'];
                $total_amount += $item['subtotal'];

                TransactionDetail::create([
                    'quantity' => $item['quantity'],
                    'transaction_id' => $transaction->id,
                    'product_id' => $item['item_id'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal']
                ]);

                $currentItem = Product::find($item['item_id']);
                if ($data['transaction_type'] == 'in') {
                    $currentItem->stock += $item['quantity'];
                } else {
                    $currentItem->stock -= $item['quantity'];
                }
                $currentItem->save();
            }

            $tax = $total_amount * 0.11;

            $transaction->tax = $tax;
            $transaction->total_amount = $total_amount + $tax;
            $transaction->save();

            DB::commit();
            return ['success' => true, 'message' => 'The transaction has been added!'];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    public function showTransactionDetails(Transaction $transaction)
    {
        $subtotal = $transaction->transactionDetails->sum(function ($detail) {
            return $detail->quantity * $detail->price;
        });

        $tax = $subtotal * 0.11;
        $total = $subtotal + $tax;

        return [
            'transaction' => $transaction->load('transactionDetails.product'),
            'subtotal' => $subtotal,
            'tax' => $tax,
            'total' => $total
        ];
    }
}
