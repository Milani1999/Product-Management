<x-app-layout>
    @extends('welcome')
    <div class="container mt-3">
        <h1>Donations History</h1>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <table class="table mt-3">
            <thead class="table-primary">
                <tr>
                    <th>User Name</th>
                    <th>User Email</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Donated Quantity</th>
                    <th>Donated Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        <td>{{ $donation->user->name }}</td>
                        <td>{{ $donation->user->email }}</td>
                        <td>{{ $donation->product->product_name }}</td>
                        <td>{{ $donation->product->description }}</td>
                        <td>{{ $donation->quantity }}</td>
                        <td>{{ $donation->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
