@extends('layouts.app')

@section('content')
<div class="container my-5">
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Order #{{ $order->id }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Status:</strong> <span class="badge bg-info text-dark">{{ ucfirst($order->status) }}</span></p>
            <p><strong>Total Price:</strong> ${{ number_format($order->total_price, 2) }}</p>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-header">
            <h3 class="mb-0">Order Items</h3>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>food Item</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->food->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>${{ number_format($item->food->price, 2) }}</td>
                            <td>${{ number_format($item->quantity * $item->food->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="mt-4">
        <a href="{{ route('orders.index') }}" class="btn btn-primary">Back to Orders</a>
    </div>
</div>
@endsection