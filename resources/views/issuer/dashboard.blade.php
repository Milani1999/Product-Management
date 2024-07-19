@include('issuer_layout.app')
@extends('welcome')

<div class="container mt-3">
    <h1>Inventory Dashboard</h1>
    <table class="table mt-3">
        <thead class="table-primary">
            <tr>
                <th>Product Name</th>
                <th>Product Description</th>
                <th>Remaining Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donation->product->product_name }}</td>
                    <td>{{ $donation->product->description }}</td>
                    <td>{{ $donation->remaining_quantity }}</td>
                    <td>
                        <a href="{{ route('issuer.issues', $donation->id) }}" class="btn btn-primary">Issue</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
