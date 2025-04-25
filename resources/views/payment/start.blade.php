@extends('layouts.app')

@section('content')
    <h2>Pay with Card</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('payment.initiate') }}" method="POST">
        @csrf
        <label>Amount</label>
        <input type="number" name="amount" step="0.01" required><br>

        <label>Card Number</label>
        <input type="text" name="card_number" required><br>

        <label>Expiry Month (MM)</label>
        <input type="number" name="expiry_month" required><br>

        <label>Expiry Year (YY)</label>
        <input type="number" name="expiry_year" required><br>

        <label>CVV</label>
        <input type="text" name="cvv" required><br>

        <button type="submit">Pay Now</button>
    </form>
@endsection
