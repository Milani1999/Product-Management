@include('donator_layout.app')
@extends('welcome')
<div class="container mt-3">
    <h1>My Donations</h1>
    <div class="card-body">
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($donations->isEmpty())
            <p>No donations found.</p>
        @else
            <table class="table mt-3">
                <thead class="table-primary">
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Quantity Donated</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donations as $donation)
                        <tr>
                            <td>{{ $donation->product->product_name }}</td>
                            <td>{{ $donation->product->discription }}</td>
                            <td>{{ $donation->quantity }}</td>
                            <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

</div>
