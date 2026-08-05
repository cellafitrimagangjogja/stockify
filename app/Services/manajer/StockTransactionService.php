<?php

namespace App\Services\manajer;

use App\Models\StockTransaction;

class StockTransactionService
{


    public function update($id, array $data)
    {
        $transaction = StockTransaction::findOrFail($id);

        $transaction->update([
            'product_id' => $data['product_id'],
            'quantity' => $data['quantity'],
            'date' => $data['date'],
            'notes' => $data['notes'] ?? null,
        ]);

        return $transaction;
    }

    public function delete($id)
    {
        return StockTransaction::destroy($id);
    }
}