@include('issuer_layout.app')
@extends('welcome')

<div class="container">
    <form method="POST" action="{{ route('issuer.issues', $inventory) }}">
        @csrf
        <div class="form-group">
            <label for="quantity">Quantity to Issue (Max: {{ $inventory->quantity }})</label>
            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror"
                name="quantity" value="{{ old('quantity') }}" required autofocus max="{{ $inventory->quantity }}">
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Issue Inventory</button>
    </form>
</div>
