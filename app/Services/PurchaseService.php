<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Product;
use App\Models\StockMovement;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PurchaseService
{
    public function getAllPurchases($filters)
    {
        return Purchase::filter($filters)->with('supplier')->latest()->simplePaginate(7)->withQueryString();
    }

    public function createPurchase($data)
    {
        try {
            DB::beginTransaction();

            $purchase = Purchase::create([
                'purchase_date' => $data['date'],
                'invoice_number' => $data['invoice_number'],
                'supplier_id' => $data['supplier_id'],
                'notes' => $data['notes'],
                'total_amount' => 0,
                'tax' => 0,
                'user_id' => Auth::user()->id,
            ]);

            $totalAmount = 0;

            foreach ($data['items'] as $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $totalAmount += $subtotal;

                PurchaseDetail::create([
                    'product_id' => $item['item_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                    'purchase_id' => $purchase->id,
                ]);

                $currentItem = Product::find($item['item_id']);
                $currentItem->stock += $item['quantity'];
                $currentItem->save();

                StockMovement::create([
                    'product_id' => $item['item_id'],
                    'type' => 'in',
                    'quantity' => $item['quantity'],
                    'reference_type' => 'Purchase',
                    'reference_id' => $purchase->id,
                ]);
            }

            $purchase->tax = $totalAmount * 0.11;
            $purchase->total_amount = $totalAmount + $purchase->tax;
            $purchase->save();

            DB::commit();
            return ['success' => true, 'message' => 'The transaction has been added!'];
        } catch (QueryException $error) {
            DB::rollBack();
            return ['success' => false, 'message' => $error->getMessage()];
        }
    }
}
