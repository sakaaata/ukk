@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Pesanan Anda</h1>
    
    @if($orders->count() > 0)
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No. Pesanan</th>
                    <th>Tanggal</th>
                    <th>Total Harga</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->created_at->format('d-m-Y H:i') }}</td>
                        <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                        <td>
                            @switch($order->status)
                                @case('pending')
                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                    @break
                                @case('processing')
                                    <span class="badge bg-info text-dark">Diproses</span>
                                    @break
                                @case('completed')
                                    <span class="badge bg-success">Selesai</span>
                                    @break
                                @case('cancelled')
                                    <span class="badge bg-danger">Dibatalkan</span>
                                    @break
                                @default
                                    <span class="badge bg-secondary">{{ $order->status }}</span>
                            @endswitch
                        </td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-warning" role="alert">
            Anda belum memiliki pesanan.
        </div>
    @endif
    
    <div class="mt-4 d-flex justify-content-end">
        <a href="{{ route('dashboard') }}" class="btn btn-success">Pesan Makanan</a>
    </div>
</div>
@endsection
