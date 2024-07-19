@include('issuer_layout.app')
@extends('welcome')

<div class="container mt-3">

    @if (session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Issued Products</h1>
    <table class="table mt-3">
        <thead class="table-primary">
            <tr>
                <th>Product Name</th>
                <th>Description</th>
                <th>Quantity Issued</th>
                <th>Issue Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($issues as $issue)
                <tr>
                    <td>{{ $issue->product->product_name }}</td>
                    <td>{{ $issue->product->description }}</td>
                    <td>{{ $issue->quantity }}</td>
                    <td>{{ $issue->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
