@include('issuer_layout.app')
@extends('welcome')

<div class="container">
    <h1>Inventory Dashboard</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($inventory as $item)
                <tr>
                    <td>{{ $item->product->product_name }}</td>
                    <td>{{ $item->product->description }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>
                        <a href="{{ route('issuer.issues', ['product' => $item->product->id]) }}" class="btn btn-primary">Issue</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
