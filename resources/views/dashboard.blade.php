@extends('layouts.app')
@vite('resources/css/app.css')
@section('content')
@php
    $envelopes = $envelopes ?? [];
@endphp
<div class="container  main-container">

    <div class="card mt-2">
        <div class="card-header">
            <span class="text-xl mb-2 block">Total: ${{ Auth::user()->total }}</span>
        </div>

        <div class="card-body">
            <form id="envelopeForm" method="POST" action="{{ route('envelopes.store') }}" class="flex justify-between items-end mb-3">
                @csrf

                <div class="w-2/5">
                    <label for="name" class="form-label">Envelope Name</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>

                <div class="w-2/5">
                    <label for="budgeted_amount" class="form-label">Budgeted Amount</label>
                    <input type="number" step="0.01" class="form-control" id="goal" name="goal" required>
                </div>

                <button type="submit" class="btn btn-primary">Create Envelope</button>
            </form>
            <div id="responseMessage" class="mt-3"></div>
        </div>

        <div class="card-body">
            <ul id="envelopeList" class="list-group">
                @foreach($envelopes as $envelope)
                    <li class="list-group-item  p-6 bg-green-100 rounded-md  mb-6 shadow-sm mt-6">
                        {{-- @dump($envelope) --}}
                        <div class="flex justify-between w-full items-center">
                            <h3>{{ $envelope->title }}</h5>
                                <div class="budget">
                                    <span>{{ $envelope->total }}/{{ $envelope->goal }}</span>
                                </div>
                                <form method="POST" action="{{ route('envelopes.destroy', $envelope->id) }}" class="m-0 float-right">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <img class="h-6 w-auto object-cover" src="{{ asset('images/trash.png') }}" alt="Delete">
                                    </button>
                                </form>
                        </div>

                        <form id="transactionForm" method="POST" action="{{ route('transactions.store', $envelope->id) }}" class="flex justify-between items-end mb-3">
                            @csrf
                            <div class="w-4/12">
                                <label for="description" class="form-label">Transaction Title</label>
                                <input type="text" class="form-control" id="title" name="title" required>
                            </div>
                            <div class="w-4/12">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
                            </div>
                            <div class="w-2/12">
                                <label for="type" class="form-label">Type</label>
                                <div class="">
                                    <select class="form-control" name="type" id="type" required>
                                        <option value="expense">Expense</option>
                                        <option value="income">Income</option>
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Add Transaction</button>
                        </form>
                        <div class="list-group mt-4">
                            <p class="mb-2 text-lg font-bold"> Transactions</p>
                            @foreach($envelope->transactions as $transaction)
                                <div class="list-group-item flex justify-between items-center py-1 px-4 bg-blue-200 mb-3 rounded-md border-slate-500 shadow-md">
                                    <div class="content py-3">
                                        <strong>{{ $transaction->title }}</strong> - ${{ $transaction->amount }} ({{ $transaction->type }})
                                    </div>
                                    <form method="POST" action="{{ route('transactions.destroy', [$envelope->id, $transaction->id]) }}" class="m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            <img class="h-6 w-auto object-cover" src="{{ asset('images/trash.png') }}" alt="Delete">
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                            </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
