<x-app-layout>
    @extends('welcome')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="container">
                        <table class="table">
                            <thead>
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
