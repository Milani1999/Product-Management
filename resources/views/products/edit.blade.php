<x-app-layout>
    @extends('welcome')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Product</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('products.update', $product->id) }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="product_name">Product Name</label>
                                <input id="product_name" type="text"
                                    class="form-control @error('product_name') is-invalid @enderror" name="product_name"
                                    value="{{ old('product_name', $product->product_name) }}" required
                                    autocomplete="product_name" autofocus>

                                @error('product_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                    autocomplete="description">{{ old('description', $product->description) }}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input id="quantity" type="number"
                                    class="form-control @error('quantity') is-invalid @enderror" name="quantity"
                                    value="{{ old('quantity', $product->quantity) }}" required autocomplete="quantity">

                                @error('quantity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">Update Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
