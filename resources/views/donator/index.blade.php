@include('donator_layout.app')
@extends('welcome')
<div class="container mt-3">
    <h1>My Donations</h1>
    <div class="card-body">
        <table class="table mt-3">
            <thead class="table-primary">
                <tr>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Quantity Donated</th>
                    <th>Donated Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $donation->product->product_name }}</td>
                        <td>{{ $donation->product->description }}</td>
                        <td>{{ $donation->quantity }}</td>
                        <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</div>
