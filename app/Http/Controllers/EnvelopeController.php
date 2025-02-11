<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Envelope;
use Illuminate\Support\Facades\Auth;

class EnvelopeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }

    // Store a new envelope (AJAX request)
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'budgeted_amount' => 'required|numeric|min:0',
        ]);

        Envelope::create([
            'name' => $request->name,
            'budgeted_amount' => $request->budgeted_amount,
            'spent_amount' => 0,
            'user_id' => Auth::id(),
        ]);

        return response()->json(['success' => true, 'message' => 'Envelope created successfully!']);
    }

    // Return a list of envelopes (for AJAX)
    public function list()
    {
        return response()->json(Envelope::all());
    }
}
