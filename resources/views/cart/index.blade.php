@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Keranjang Belanja</h1>
    @if($cartitem->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>food</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Subtotal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cartitem as $item)
                    <tr>
                        <td>{{ $item->food->name }}</td>
                        <td>Rp {{ number_format($item->food->price, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.update', $item) }}" method="POST" class="form-inline">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control form-control-sm" style="width: 60px;">
                                <button type="submit" class="btn btn-sm btn-secondary ml-2">Update</button>
                            </form>
                        </td>
                        <td>Rp {{ number_format($item->food->price * $item->quantity, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                        
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-right"><strong>Total:</strong></td>
                    <td><strong>Rp {{ number_format($cartitem->sum(function($item) { return $item->food->price * $item->quantity; }), 0, ',', '.') }}</strong></td>
                    <td></td>
                </tr>
            </tfoot>
        </table>
        <div class="text-right">
            <a href="{{ route('checkout.create') }}" class="btn btn-success">Checkout</a>
        </div>
    @else
        <p>Keranjang belanja Anda kosong.</p>
    @endif
</div>
@endsection