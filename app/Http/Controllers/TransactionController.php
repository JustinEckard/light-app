<?php

namespace App\Http\Controllers;

use App\Models\Envelope;
use App\Http\Controllers\EnvelopeController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helpers;


class TransactionController extends Controller
{
    public function store(Request $request, Envelope $envelope)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'type' => 'required|in:expense,income',
        ]);

        $transaction_value = $validated['amount'];

        if ($validated['type'] === 'expense'){
            $transaction_value = -$transaction_value;
        }

        $new_transaction = [
            'title' => $validated['title'],
            'amount' => $transaction_value,
            'type' => $validated['type'],
            'envelope_id' => $envelope->id,
        ];
        $transaction = new Transaction($new_transaction);

        $transaction->envelope()->associate($envelope);
        $transaction->save();

        // Reload transactions relationship
        $envelope->load('transactions');

        $total = 0;
        foreach ($envelope->transactions as $transaction) {
            $total += $transaction->amount;
        }
        $envelope->total = $total;
        $envelope->save();

        Helpers::updateUserTotal(Auth::user());
        return redirect()->route('dashboard')->with('success', 'Transaction added successfully.');
    }

    public function destroy(Envelope $envelope, Transaction $transaction)
    {
        $transaction->delete();

        // Reload transactions relationship
        $envelope->load('transactions');

        $total = 0;
        foreach ($envelope->transactions as $transaction) {
            $total += $transaction->amount;
        }
        $envelope->total = $total;
        $envelope->save();

        Helpers::updateUserTotal(Auth::user());

        return redirect()->route('dashboard')->with('success', 'Transaction deleted successfully.');
    }

    public function list()
    {
        return response()->json(Transaction::all());
    }


}
