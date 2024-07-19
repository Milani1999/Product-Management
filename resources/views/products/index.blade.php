@include('donator_layout.app')
@extends('welcome')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('products.create') }}" class="btn btn-success">Add New Product</a>
    </div>
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
<script>
    function deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            console.log('Attempting to delete product with ID:', productId);
            $.ajax({
                url: '/products/' + productId,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Server response:', response);
                    $('#product_' + productId).remove();
                    alert('Product deleted successfully.');
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    console.error('Status:', status);
                    console.error('XHR:', xhr);
                    alert('Failed to delete product.');
                }
            });
        }
    }
</script>
