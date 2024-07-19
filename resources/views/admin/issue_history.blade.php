<x-app-layout>
    @extends('welcome')
    <div class="container mt-3">
        <h1>Issues History</h1>
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
                    <th>Issued Quantity</th>
                    <th>Issued Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($issues as $issue)
                    <tr>
                        <td>{{ $issue->user->name }}</td>
                        <td>{{ $issue->user->email }}</td>
                        <td>{{ $issue->product->product_name }}</td>
                        <td>{{ $issue->product->description }}</td>
                        <td>{{ $issue->quantity }}</td>
                        <td>{{ $issue->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
