@extends('layouts.app')
@vite('resources/css/app.css')
@section('content')
<div class="container">
    <h2>Dashboard</h2>

    <!-- Envelope Creation Form -->
    <div class="card">
        <div class="card-header">Create a New Envelope</div>
        <div class="card-body">
            <form id="envelopeForm">
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Envelope Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="budgeted_amount" class="form-label">Budgeted Amount</label>
                    <input type="number" step="0.01" class="form-control" id="budgeted_amount" name="budgeted_amount" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Envelope</button>
            </form>
            <div id="responseMessage" class="mt-3"></div>
        </div>
        <hr>
        <form id="transactionForm">
            @csrf
            <div class="mb-3">
                <label for="title">Transaction Title</label>
                <input type="text" id="description" name="description">
            </div>
            <div class="mb-3">
                <label for="amount" class="form-label">Amount</label>
                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
            </div>
            <select name="type" id="type">
                <option value="expense">Expense</option>
                <option value="income"></option>
            </select>
            <button type="submit" class="btn btn-primary">Create Envelope</button>
        </form>
    </div>

    <!-- List of Envelopes -->
    <div class="card mt-4">
        <div class="card-header">My Envelopes</div>
        <div class="card-body">
            <ul id="envelopeList" class="list-group">
                <!-- Envelopes will be loaded here via JavaScript -->
            </ul>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-header">My Transactions</div>
        <div class="card-body">
            <ul id="transactionList" class="list-group">
                <!-- Envelopes will be loaded here via JavaScript -->
            </ul>
        </div>
    </div>
</div>
@endsection
