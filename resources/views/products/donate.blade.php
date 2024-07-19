@include('donator_layout.app')
@extends('welcome')
    <div class="container mt-3">
        <h1>Donate: {{ $product->product_name }}</h1>
        <form method="POST" action="{{ route('products.donate.submit', $product) }}">
            @csrf
            <div class="form-group mt-3">
                <label for="quantity">Quantity to Donate (Max: {{ $product->quantity }})</label>
                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror"
                    name="quantity" value="{{ old('quantity') }}" required autofocus>
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary mt-3">Submit Donation</button>
        </form>
    </div>


