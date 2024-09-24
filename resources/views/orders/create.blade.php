@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Checkout</h1>
    <div class="row">
        <!-- Order Summary -->
        <div class="col-md-8 mb-4">
            <h2 class="mb-3">Ringkasan Pesanan</h2>
            <table class="table table-bordered table-striped">
                <thead class="table-light">
                    <tr>
                        <th>Menu</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cartItems as $item)
                        <tr>
                            <td>{{ $item->food->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>Rp {{ number_format($item->food->price, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($item->food->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="text-end"><strong>Total:</strong></td>
                        <td><strong>Rp {{ number_format($total, 0, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- Order Confirmation -->
        <div class="col-md-4">
            <h2 class="mb-3">Konfirmasi Pesanan</h2>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="address" class="form-label">Alamat Pengiriman</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required placeholder="Masukkan alamat pengiriman">{{ old('address') }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel" name="phone" id="phone" class="form-control" required placeholder="Masukkan nomor telepon" value="{{ old('phone') }}">
                        </div>
                        <button type="submit" class="btn btn-success w-100">Konfirmasi Pesanan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
