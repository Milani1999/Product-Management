<x-app-layout>
    @extends('welcome')
    <div class="container mt-3">

        <h2>Inventory</h2>

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        <table class="table mt-3">
            <thead class="table-primary">
                <tr>
                    {{-- <th>User Name</th>
                                    <th>User Email</th> --}}
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Product Description</th>
                    <th>Remaining Quantity</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($donations as $donation)
                    <tr>
                        {{-- <td>{{ $donation->user->name }}</td>
                                        <td>{{ $donation->user->email }}</td> --}}
                        <td>{{ $donation->product->id }}</td>
                        <td>{{ $donation->product->product_name }}</td>
                        <td>{{ $donation->product->description }}</td>
                        <td>{{ $donation->remaining_quantity }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
