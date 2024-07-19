@include('donator_layout.app')
@extends('welcome')
<div class="container mt-3">
    <h1>Products</h1>
    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
    </div>
    <table class="table mt-3">
        <thead class="table-primary">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr id="product_{{ $product->id }}">
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-info">Edit</a>
                        {{-- <button class="btn btn-danger" onclick="deleteProduct({{ $product->id }})">Delete</button> --}}
                        <a href="{{ route('products.donate', $product) }}" class="btn btn-primary">Donate Now</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>


@if (Session::has('message'))
    <script>
        toastr.success("{{ Session::get('message') }}")
    </script>
@endif

