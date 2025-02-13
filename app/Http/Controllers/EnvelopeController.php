<?php
namespace App\Http\Controllers;



use App\Models\Envelope;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Helpers;


class EnvelopeController extends Controller
{
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'goal' => 'required|numeric|min:0',
        ]);
        
        Envelope::create([
            'title' => $request->title,
            'goal' => $request->goal,
            'total' => 0,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('dashboard')->with('success', 'Envelope added successfully.');
    }

    public function destroy(Envelope $envelope)
    {
        $envelope->delete();
        Helpers::updateUserTotal(Auth::user());
        return redirect()->route('dashboard')->with('success', 'Envelope deleted successfully.');
    }

    // Return a list of envelopes (for AJAX)
    public function list()
    {
        return response()->json(Envelope::all());
    }

}
