@include('issuer_layout.app')
@extends('welcome')

<div class="container">
    <h1>Issue: {{ $donation->product->product_name }}</h1>

    <form method="POST" action="{{ route('issuer.issue.submit', $donation->id) }}">
        @csrf

        <div class="form-group">
            <label for="quantity">Quantity to Issue (Max: {{ $donation->remaining_quantity }})</label>
            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror"
                name="quantity" value="{{ old('quantity') }}" required autofocus max="{{ $donation->remaining_quantity }}">
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Issue Product</button>
    </form>
</div>

