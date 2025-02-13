<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Envelope;

class DashboardController extends Controller
{
    public function index()
    {
        $envelopes = Envelope::with('transactions')->get();

        return view('dashboard', compact('envelopes'));
    }
}