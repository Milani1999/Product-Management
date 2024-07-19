@include('issuer_layout.app')
@extends('welcome')

<div class="container mt-3">
    <h1>Issue: {{ $donation->product->product_name }}</h1>

    <form id="issueForm" method="POST" action="{{ route('issuer.issue.submit', $donation->id) }}">
        @csrf

        <div class="form-group mt-3">
            <label for="quantity">Quantity to Issue (Max: {{ $donation->remaining_quantity }})</label>
            <input id="quantity" type="number" class="form-control @error('quantity') is-invalid @enderror"
                name="quantity" value="{{ old('quantity') }}" required autofocus
                max="{{ $donation->remaining_quantity }}">
            @error('quantity')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Issue Product</button>
    </form>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        $('#issueForm').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const url = form.attr('action');
            const method = form.attr('method');
            const data = form.serialize();

            $.ajax({
                url,
                type: method,
                data,
                success: ({
                    success,
                    message,
                    redirect
                }) => {
                    toastr.success(message);
                    form[0].reset();
                    setTimeout(() => window.location.href = redirect);
                },
                error: ({
                    responseJSON
                }) => {
                    esponseJSON && responseJSON.errors
                    Object.values(responseJSON.errors).forEach(value => toastr.error(value[
                        0]));
                }
            });
        });
    });
</script>
