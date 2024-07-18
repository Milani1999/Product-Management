<x-app-layout>
    @extends('welcome')

    <div class="container">
        <h1>Donate: {{ $product->name }}</h1>
        <form method="POST" action="{{ route('products.donate.submit', $product) }}">
            @csrf
            <div class="form-group">
                <label for="quantity">Quantity to Donate (Max: {{ $product->quantity }})</label>
                <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror"
                    name="quantity" value="{{ old('quantity') }}" required autofocus>
                @error('quantity')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit Donation</button>
        </form>
    </div>


</x-app-layout>
