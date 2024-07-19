<x-app-layout>
    @extends('welcome')
    <div class="container mt-3">
        <h1>Dashboard</h1>

        <div class="mb-5">
            <h2>Top Products Donated</h2>
            <div style="position: relative; height:40vh; width:80vw">
                <canvas id="top-products-chart" style="height: 100px;"></canvas>
            </div>
        </div>

        <div class="mb-5">
            <h2>Top 5 Donors</h2>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>User</th>
                        <th>Total Donated Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($topDonors as $donor)
                        <tr>
                            <td>{{ $donor->user->name }}</td>
                            <td>{{ $donor->total_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div>
            <h2>Low Stock Products</h2>
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lowStockProducts as $donation)
                        <tr>
                            <td>{{ $donation->product->product_name }}</td>
                            <td>{{ $donation->product->description }}</td>
                            <td>{{ $donation->remaining_quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('top-products-chart').getContext('2d');
            const topProductsChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ["tea", "School Bag", "Bags", "pencil", "ring"],
                    datasets: [{
                        label: 'Total Donated Quantity',
                        data: [202, 7, 4, 3, 1],
                        backgroundColor: 'rgba(178,190,181, 0.2)',
                        borderColor: 'rgba(0, 0, 0, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-app-layout>
