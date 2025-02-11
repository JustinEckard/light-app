<?php

namespace App\Http\Controllers;

use App\Models\Envelope;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;


class TransactionController extends Controller
{
    public function store(Request $request, $envelopeId)
    {
        $request->validate([
            'description' => 'required|string|max:100',
            'amount' => 'required|numeric',
            'type' => 'required|string|in:income,expense',
        ]);

        // Create the transaction
        $amount = $request->amount;

        if($request->type == 'expense' ){
            $amount = $request->amount*-1;
        }

        Transaction::create([
            'user_id' => Auth::id(), // Authenticated users
            'envelope_id' => $envelopeId,
            'description' => $request->description,
            'type' => $request->type,
            'amount' => $amount,
        ]);

        // Update the envelope's total
        // $envelope = Envelope::findOrFail($envelopeId);
        // $envelope->updateTotal();

        // $user = User::findOrFail(Auth::id());
        // $user->updateTotal();

        return back()->with('success', 'Transaction added successfully.');
    }

    public function list()
    {
        return response()->json(Transaction::all());
    }
}
